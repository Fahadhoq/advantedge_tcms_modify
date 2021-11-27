<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseGLCode;
use App\Models\User;
use Validator;
use Illuminate\Support\Str;
use Storage;

class ExpenseController extends Controller
{
    public function index()
    {
        $data['Expenses'] = Expense::get();
        $data['ExpenseGLCodes'] = ExpenseGLCode::get();
      
        return view('Backend.Expense.index' , $data);
    }

    public function create(){

        $data['ExpenseGLCodes'] = ExpenseGLCode::get();

        return view('Backend.Expense.create' , $data);
    }

    public function store(Request $request )
    {  
        
        //for backendend validation
        $validator = Validator::make($request->all(), [
            'ExpenseDate' => 'required',
            'ExpenseAmount' => 'required',
            'ExpenseGLCode' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
         }

        //image validation and storage 
      if(($request->file('Money_Receipt_Image') != null) ){

            $validator_img = Validator::make($request->all(), [
                'Money_Receipt_Image' => 'required|image|max:10240',
            ]);

        if($validator->fails() || $validator_img->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        if($request->file('Money_Receipt_Image')){

            $imageFile = $request->file('Money_Receipt_Image');

            $file_name = uniqid('Money-Receipt-Image/' , true ).Str::random(10).'.'.$imageFile->getClientOriginalExtension();

            if($imageFile->isvalid()){
                $imageFile->move(public_path('storage\Money-Receipt-Image'), $file_name);       
            }
        }

      }
      //image validation and storage end

        
    try{
        
        //expense table insert
        $Expense = new Expense;
        $Expense->gl_code_id = $request->ExpenseGLCode;
        $Expense->amount = $request->ExpenseAmount;
        $Expense->expense_date = $request->ExpenseDate;
        $Expense->user_id = auth()->user()->id;
        if($request->file('Money_Receipt_Image')){
            $Expense->money_receipt = $file_name;
        }
        if($request->ExpenseRemark != null){
            $Expense->remark = $request->ExpenseRemark;
        }
        $Expense->save();
        
        $this->SetMessage('Expense Create Successfull' , 'success');
        
        return  redirect('/expense');

       } catch (Exception $e){

          $this->SetMessage($e->getMessage() , 'danger');

           return redirect()->back();
       }
        
    }

    public function edit(Request $request){

        $id = $request->id;
        $data['Expense'] = Expense::where('id', $id)->first();

        $data['ExpenseGLCodes'] = ExpenseGLCode::get();
      
        return view('Backend.Expense.edit' , $data);
    }

    public function update(Request $request){
    
        $validator = Validator::make($request->all(), [
            'ExpenseDate' => 'required',
            'ExpenseAmount' => 'required',
            'ExpenseGLCode' => 'required',
      ]);

      //image validation and storage 
      if(($request->file('Money_Receipt_Image') != null) || ($request->old_pic != null) ){

        if( $request->file('Money_Receipt_Image') ) {
            $validator_img = Validator::make($request->all(), [
                'Money_Receipt_Image' => 'required|image|max:10240',
            ]);
            
        }elseif($request->old_pic){
            $validator_img = Validator::make($request->all(), [
                'old_pic' => 'required|unique:expenses,money_receipt,'.$request->id,
            ]);
        }

        if($validator->fails() || $validator_img->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        if($request->file('Money_Receipt_Image')){

            $imageFile = $request->file('Money_Receipt_Image');

            $file_name = uniqid('Money-Receipt-Image/' , true ).Str::random(10).'.'.$imageFile->getClientOriginalExtension();

            if($imageFile->isvalid()){
                $imageFile->move(public_path('storage\Money-Receipt-Image'), $file_name);       
            }
        }

      }
      //image validation and storage end
     

        try{

            $id = $request->id;
            
            //update Expense table
            $Expense = Expense::find($id);
            $Expense->gl_code_id = $request->ExpenseGLCode;
            $Expense->amount = $request->ExpenseAmount;
            $Expense->expense_date = $request->ExpenseDate;
            $Expense->user_id = auth()->user()->id;

            if($request->file('Money_Receipt_Image')){
                $Expense->money_receipt = $file_name;
            }
            if($request->ExpenseRemark != null){
                $Expense->remark = $request->ExpenseRemark;
            }
            $Expense->save();
            
            $this->SetMessage('Expense Update Successfull' , 'success');
            
            $data['Expenses'] = Expense::get();
            
            return redirect('/expense')->with($data);
            
        
        }catch (Exception $e){
            
            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }
        
    }

    public function image_delete(Request $request ,$id){
      
        $Expense = Expense::find($request->id);

        unlink(public_path('/storage/'.$Expense->money_receipt));

        $Expense->money_receipt = null;
        $Expense->save();
         
        $id = $request->id;

        return response()->json([ 'success' => 'Money Receipt Delete Successfull' ]);

     }

    public function delete(Request $request, $id){
                  
        $Expense = Expense::find($id);

        $Expense->delete();

        return response()->json([ 'success' => 'Expense Delete Successfull']);

     }

     public function expense_index_filter(Request $request){

        $output = '';
        $i = 1;
                  
       if($request->filter_type > 0){

          $Individual_Expenses = Expense::where('gl_code_id' , $request->filter_type)->get();

           $total_expense_amount = 0;
           foreach($Individual_Expenses as $Individual_Expense){

               $user = User::where('id' , $Individual_Expense->user_id)->first();
               $gl_code = ExpenseGLCode::where('id' , $Individual_Expense->gl_code_id)->first();
               $total_expense_amount = $total_expense_amount + $Individual_Expense->amount;
           
                    $output .=     '<tr>
                                        <td style=text-align:center scope="row">' .$i++. '</td> 
                                        
                                        <!-- expense info -->
                                        <td style=text-align:center scope="row">' .$Individual_Expense->id. '</td>
                                        <td style=text-align:center scope="row">
                                            <img class="rounded-circle z-depth-2" width="60px" height="60px" src="storage/'.$Individual_Expense->money_receipt. '"
                                                                data-holder-rendered="true">
                                        </td>                    
                                        <td style=text-align:center scope="row">' .$gl_code->name. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Expense->amount. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Expense->remark. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Expense->expense_date. '</td>
                                        <td style=text-align:center scope="row">' .$user->name. '</td>
                                        <!-- expense info end -->

                                        <td style=text-align:center>
                                            <!-- <a href="" class="btn btn-info btn-sm" title="View course"><i class="fa fa-eye"></i></a> -->
                                            <!-- jquery view -->
                                            <a  name="view" value="view" id="'.$Individual_Expense->id.'" class="btn btn-info btn-sm view_enrolled_course" title="View enrolled course"><i class="fa fa-eye"></i></a>
                                            <!-- jquery view end-->

                                            <a href="/expense-edit-'.$Individual_Expense->id.'" class="btn btn-warning btn-sm" title="Edit Expense"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm delete" data-id="'.$Individual_Expense->id.'" value="'.$Individual_Expense->id.'"><i class="fa fa-trash"></i></button>   
                                        </td>
                                
                                    </tr>';                            
           }
           $output .= ' 
                                <tr>
                                    <th style=text-align:right colspan="4">Total</th>
                                    <th style=text-align:center;color:blue>'.$total_expense_amount.'</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>';

       }

       echo $output;

     }
}

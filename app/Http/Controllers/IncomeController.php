<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\IncomeGLCode;
use App\Models\User;
use Validator;
use Illuminate\Support\Str;
use Storage;

class IncomeController extends Controller
{
    public function index()
    {
        $data['Incomes'] = Income::get();
        $data['IncomeGLCodes'] = IncomeGLCode::get();
      
        return view('Backend.Income.index' , $data);
    }

    public function create(){

        $data['IncomeGLCodes'] = IncomeGLCode::get();

        return view('Backend.Income.create' , $data);
    }

    public function store(Request $request )
    {  
        
        //for backendend validation
        $validator = Validator::make($request->all(), [
            'IncomeDate' => 'required',
            'IncomeAmount' => 'required',
            'IncomeGLCode' => 'required',
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

            $file_name = uniqid('Income-Money-Receipt-Image/' , true ).Str::random(10).'.'.$imageFile->getClientOriginalExtension();

            if($imageFile->isvalid()){
                $imageFile->move(public_path('storage\Income-Money-Receipt-Image'), $file_name);       
            }
        }

      }
      //image validation and storage end

        
    try{
        
        //Income table insert
        $Income = new Income;
        $Income->gl_code_id = $request->IncomeGLCode;
        $Income->amount = $request->IncomeAmount;
        $Income->income_date = $request->IncomeDate;
        $Income->receiver_id = auth()->user()->id;
        if($request->file('Money_Receipt_Image')){
            $Income->money_receipt = $file_name;
        }
        if($request->IncomeRemark != null){
            $Income->remark = $request->IncomeRemark;
        }
        $Income->save();
        
        $this->SetMessage('Income Create Successfull' , 'success');
        
        return  redirect('/income');

       } catch (Exception $e){

          $this->SetMessage($e->getMessage() , 'danger');

           return redirect()->back();
       }
        
    }

    public function edit(Request $request){

        $id = $request->id;
        $data['Income'] = Income::where('id', $id)->first();

        $data['IncomeGLCodes'] = IncomeGLCode::get();
      
        return view('Backend.Income.edit' , $data);
    }

    public function update(Request $request){
    
        $validator = Validator::make($request->all(), [
            'IncomeDate' => 'required',
            'IncomeAmount' => 'required',
            'IncomeGLCode' => 'required',
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

            $file_name = uniqid('Income-Money-Receipt-Image/' , true ).Str::random(10).'.'.$imageFile->getClientOriginalExtension();

            if($imageFile->isvalid()){
                $imageFile->move(public_path('storage\Income-Money-Receipt-Image'), $file_name);       
            }
        }

      }
      //image validation and storage end
     

        try{

            $id = $request->id;
            
            //update Income table
            $Income = Income::find($id);
            $Income->gl_code_id = $request->IncomeGLCode;
            $Income->amount = $request->IncomeAmount;
            $Income->income_date = $request->IncomeDate;
            $Income->receiver_id = auth()->user()->id;

            if($request->file('Money_Receipt_Image')){
                $Income->money_receipt = $file_name;
            }
            if($request->IncomeRemark != null){
                $Income->remark = $request->IncomeRemark;
            }
            $Income->save();
            
            $this->SetMessage('Income Update Successfull' , 'success');
            
            $data['Incomes'] = Income::get();
            
            return redirect('/income')->with($data);
            
        
        }catch (Exception $e){
            
            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }
        
    }

    public function image_delete(Request $request ,$id){
      
        $Income = Income::find($request->id);

        unlink(public_path('/storage/'.$Income->money_receipt));

        $Income->money_receipt = null;
        $Income->save();
         
        $id = $request->id;

        return response()->json([ 'success' => 'Money Receipt Delete Successfull' ]);

     }

     public function delete(Request $request, $id){
                  
        $Income = Income::find($id);

        $Income->delete();

        return response()->json([ 'success' => 'Income Delete Successfull']);

     }

     public function income_index_filter(Request $request){

        $output = '';
        $i = 1;
                  
       if($request->filter_type > 0){

          $Individual_Incomes = Income::where('gl_code_id' , $request->filter_type)->get();

           $total_income_amount = 0;
           foreach($Individual_Incomes as $Individual_Income){

               $user = User::where('id' , $Individual_Income->receiver_id)->first();
               if($Individual_Income->gl_code_id == 500){
                 $gl_code = "Student Payment";
               }else{
                   $gl_code = IncomeGLCode::where('id' , $Individual_Income->gl_code_id)->first();
                   $gl_code = $gl_code->name;
               }
               
               $total_income_amount = $total_income_amount + $Individual_Income->amount;
           
                    $output .=     '<tr>
                                        <td style=text-align:center scope="row">' .$i++. '</td> 
                                        
                                        <!-- income info -->
                                        <td style=text-align:center scope="row">' .$Individual_Income->id. '</td>
                                        <td style=text-align:center scope="row">
                                            <img class="rounded-circle z-depth-2" width="60px" height="60px" src="storage/'.$Individual_Income->money_receipt. '"
                                                                data-holder-rendered="true">
                                        </td>                    
                                        <td style=text-align:center scope="row">' .$gl_code. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Income->amount. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Income->remark. '</td>
                                        <td style=text-align:center scope="row">' .$Individual_Income->income_date. '</td>
                                        <td style=text-align:center scope="row">' .$user->name. '</td>
                                        <!-- income info end -->

                                        <td style=text-align:center>
                                            <!-- <a href="" class="btn btn-info btn-sm" title="View course"><i class="fa fa-eye"></i></a> -->
                                            <!-- jquery view -->
                                            <a  name="view" value="view" id="'.$Individual_Income->id.'" class="btn btn-info btn-sm view_enrolled_course" title="View enrolled course"><i class="fa fa-eye"></i></a>
                                            <!-- jquery view end-->';
                                            if($Individual_Income->gl_code_id != 500){
                                                $output .= '  <a href="/income-edit-'.$Individual_Income->id.'" class="btn btn-warning btn-sm" title="Edit income"><i class="fa fa-edit"></i></a>
                                                              <button class="btn btn-danger btn-sm delete" data-id="'.$Individual_Income->id.'" value="'.$Individual_Income->id.'"><i class="fa fa-trash"></i></button>';
                                            }

                        $output .= '</tr>';                            
           }
           $output .= ' 
                                <tr>
                                    <th style=text-align:right colspan="4">Total</th>
                                    <th style=text-align:center;color:blue>'.$total_income_amount.'</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>';

       }

       echo $output;

     }

}

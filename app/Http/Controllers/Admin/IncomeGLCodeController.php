<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\IncomeGLCode;

class IncomeGLCodeController extends Controller
{
    public function index(){
        
        $data['IncomeGLCodes'] = IncomeGLCode::select('id' ,'name')->get();
        
        return view('Backend.Admin.GL_Code.Income_GL_Code.index' , $data );
    }

    public function create(){

        return view('Backend.Admin.GL_Code.Income_GL_Code.create' );
    }

    public function store(Request $request){
 
        $validator = Validator::make($request->all(), [
            'IncomeGLCodeName' => [
                'required',
                'regex:/^[A-Za-z0-9 ]+$/',
                'unique:income_gl_codes,name',
            ],
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        try{
            
            $ExpenseGLCode = IncomeGLCode::create([
                'name' => $request->IncomeGLCodeName
                ]);

            $this->SetMessage('Income GL Code Create Successfull' , 'success');

            $data['IncomeGLCodes'] = IncomeGLCode::select('id','name')->get();
            
            return redirect('/income_gl_code');
            

        } catch (Exception $e){

            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }      
    }

    // jquery view
    public function show(Request $request){
  
        $id = $request->id;
        if(isset($id))
         {  
              $output = '';    
              $IncomeGLCode = IncomeGLCode::where('id', $id)->first();
                     
                                      
              $output .= '  
              <div class="table-responsive">  
                   <table class="table table-bordered">';  
                   $output .= '  
                        <tr>  
                             <td width="30%"><label>id</label></td>  
                             <td width="70%">'.$IncomeGLCode->id.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>name</label></td>  
                             <td width="70%">'.$IncomeGLCode->name.'</td>  
                        </tr>
                            
                        ';   
              $output .= "</table></div>";      

              echo $output;  
//              return response()->json([ 'output' => $output]);
         }
    }

    public function delete(Request $request, $id){

        $IncomeGLCode = IncomeGLCode::find($id);

        $IncomeGLCode->delete();

        return response()->json([ 'success' => 'Income GL Code Delete Successfull']);

    }

     // jquery edit
   public function jquery_edit(Request $request){

            $id = $request->id;

            if(isset($id)){  
            $IncomeGLCode = IncomeGLCode::select('id', 'name')
                                    ->where('id', $id)
                                    ->first();

            //$row = mysqli_fetch_array($result);  
            echo json_encode($IncomeGLCode);  
        }
  }

  public function jquery_update(Request $request){
      
    $id = $request->id;
    
    $validator = Validator::make($request->all(), [
          'name' => [
              'required',
              'regex:/^[A-Za-z0-9 ]+$/',
              'unique:income_gl_codes,name,'.$id,
          ],
      ]);

      if($validator->fails()){
            return response()->json([ 'error' => 'GL Code name has already taken']);
      }

    if($id != null)  
    {  
          $IncomeGLCode = IncomeGLCode::select('id', 'name')
                            ->where('id', $id)
                            ->first();

          $IncomeGLCode->name = $request->name;
          $IncomeGLCode->save();
         // return response()->json([ 'success' => 'Permission Update Successfull']);
         
    }

    $IncomeGLCodes = IncomeGLCode::select('id' ,'name')->get(); 
    
    $output = '';

    
          $output = '    
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                      <thead class="thead-default">
                            <tr>
                                <th style=text-align:center>SL</th>
                                <th style=text-align:center>GL Code Name</th>
                                <th style=text-align:center>Action</th>
                                                 
                            </tr>
                      </thead>     
                ';
                
          
          $output .= '
               <tbody>
                      <tr>';

        $i=1;
        foreach($IncomeGLCodes as $IncomeGLCode){            
                                                  
          $output .=  '<th style=text-align:center scope="row">' .$i++. '</th>
                                                      
                          <td style=text-align:center>' .$IncomeGLCode->name. '</td>
                                    
                ';
          $output .= '
                     <td style=text-align:center>
                                                      
                          <!-- jquery view -->
                             <a name="view" value="view" id="'. $IncomeGLCode->id. '" class="btn btn-info btn-sm view_Income_GL_Code" title="View GL Code"><i class="fa fa-eye"></i></a>
                          <!-- jquery view end-->
                                                      
                          <!-- jquery edit -->  
                              <a  name="edit" value="Edit" id="'. $IncomeGLCode->id. '" class="btn btn-warning btn-sm edit_data" title="Edit GL Code"><i class="fa fa-edit"></i></a>
                          <!-- jquery edit end -->
                                                      
                          <!-- jquery delete -->
                              <button class="btn btn-danger btn-sm delete" data-id="' .$IncomeGLCode->id. '" value="{{$IncomeGLCode->id}}"><i
                                                      class="fa fa-trash"></i></button>
                          <!-- jquery delete end -->

                                                      
                      </td>
                  
                                                  
            </tr>';
                               
                               
        }

        $output .=   '    </tbody>
                                         
                                  </table>';

  echo $output;

  }    
// jquery edit end 

}

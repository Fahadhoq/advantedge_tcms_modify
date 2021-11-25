<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Classes;
use Validator;

class BatchController extends Controller
{
    public function index(){
       
        $data['batchs'] = Batch::select('id' ,'batch_name', 'class_id')->get();
      
        return view('Backend.Batch.index' , $data );
    }

    public function create(){
       
        $data['Classes'] = Classes::select('id' ,'name')->get();
       
        return view('Backend.Batch.create', $data);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'BatchName' => [
                'required',
                'regex:/^[A-Za-z0-9 ]+$/'
            ],
            'Class' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        $batchs = Batch::select('batch_name', 'class_id')->where('class_id' , $request->Class)->get();

        foreach ($batchs as $batch) {
            if($batch->batch_name == strtoupper($request->BatchName)){
                $this->SetMessage('The batch name has already been taken' , 'danger');
                return redirect()->back();
            }
        }

        try{

            $Batch = Batch::create([
                       'batch_name' =>  strtoupper($request->BatchName),
                       'class_id' => $request->Class
                    ]);

            $this->SetMessage('Batch Create Successfull' , 'success');
                
            return redirect('/batch');
            

        } catch (Exception $e){

            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }
        
    }

     // jquery view
     public function show(Request $request){
  
        $id = $request->batch_id;
              
         if(isset($id)){  
               $output = '';    
               $Batch = Batch::where('id', $id)->first();
               $class = Classes::find($Batch->class_id);
                            
               $output .= '  
                   <div class="table-responsive">  
                       <table class="table table-bordered">';  
                           $output .= '  
                               <tr>  
                                    <td width="30%"><label>id</label></td>  
                                    <td width="70%">'.$Batch->id.'</td>  
                               </tr>
                               <tr>  
                                    <td width="30%"><label>Course Name</label></td>  
                                    <td width="70%">'.$class->name.'</td>  
                               </tr>  
                               <tr>  
                                    <td width="30%"><label>Batch Name</label></td>  
                                    <td width="70%">'.$Batch->batch_name.'</td>  
                               </tr>
                       
                               ';   
               $output .= "</table></div>";      
       
               echo $output;  
       //      return response()->json([ 'output' => $output]);
           }
       }

       // jquery edit
     public function edit(Request $request){

        $id = $request->id;
  
        if(isset($id)){  
            $Batch = Batch::select('id', 'batch_name', 'class_id')
                                    ->where('id', $id)
                                    ->first();
            $Classes = Classes::select('id' ,'name')->get();
                               

            $output = '<div class="form-group"> 
                            <label >Course</label>
                                <div >
                                    <select class="form-control" name="Class" id="Class">
                                        <option value="">Choose one course </option>';
                                            foreach($Classes as $Class){
                                                $output .= '<option  id="'.$Class->id.'" value="'.$Class->id.'"'; if($Class->id == $Batch->class_id){$output.='selected';} $output.='>'.$Class->name.'</option>';
                                            }
                                                
                                $output .=  '</select>
                                </div>
                        </div>';
                        
            $output .= '<label>Batch Name</label>  
                            <input type="text" name="BatchName" id="Batch_Name" value="'.$Batch->batch_name.'" class="form-control" />  
                        <br />';
            
            $output .= '<input type="hidden" name="batch_id" id="batch_id"  value="'.$Batch->id.'" />  
                       <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />';            
                        
                        echo $output;
        
          //  echo json_encode($Subject);  
        }
    }

    public function update(Request $request){
        
        $id = $request->id;


        $batchs = Batch::select('id' ,'batch_name', 'class_id')->where('class_id' , $request->class_id)->get();

        foreach ($batchs as $batch) {
             if($batch->id != $id){
                if($batch->batch_name == strtoupper($request->name)){
                    return response()->json([ 'error' => 'Batch name has already taken']);
                }
            }
        }
  
        if($id != null){  
              $Batch = Batch::select('id', 'batch_name', 'class_id')
                                ->where('id', $id)
                                ->first();
  
              $Batch->batch_name = strtoupper($request->name);
              $Batch->class_id = $request->class_id;
              $Batch->save();
             // return response()->json([ 'success' => 'Subject Update Successfull']);       
        }
  
        $Batchs = Batch::select('id' ,'batch_name', 'class_id')->get(); 
        
        $output = '';
  
        
              $output = '    
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  
                          <thead class="thead-default">
                                <tr>
                                    <th style=text-align:center>SL</th>
                                    <th style=text-align:center>Coures Name</th>
                                    <th style=text-align:center>Batch Name</th>
                                    <th style=text-align:center>Action</th>
                                                     
                                </tr>
                          </thead>     
                    ';
                    
              
              $output .= '
                   <tbody>
                          <tr>';
  
            $i=1;
            foreach($Batchs as $Batch){            
                                                      
              $output .=  '<th style=text-align:center scope="row">' .$i++. '</th>
                              <td style=text-align:center>' .$Batch->class->name. '</td>                            
                              <td style=text-align:center>' .$Batch->batch_name. '</td>
                                        
                    ';
              $output .= '
                         <td style=text-align:center>
                                                          
                              <!-- jquery view -->
                                  <a name="view" value="view" id="'. $Batch->id. '" class="btn btn-info btn-sm view_batch" title="View Batch"><i class="fa fa-eye"></i></a>
                              <!-- jquery view end-->
                                                          
                              <!-- jquery edit -->  
                                  <a  name="edit" value="Edit" id="'. $Batch->id. '" class="btn btn-warning btn-sm edit_data" title="Edit Batch"><i class="fa fa-edit"></i></a>
                              <!-- jquery edit end -->
                                                          
                              <!-- jquery delete -->
                                  <button class="btn btn-danger btn-sm delete" data-id="' .$Batch->id. '" value="{{$Batch->id}}"><i class="fa fa-trash"></i></button>
                              <!-- jquery delete end -->
                                   
                          </td>
                      
                                                      
                </tr>';
                                   
                                   
            }
  
            $output .=   '    </tbody>
                                             
                                      </table>';
  
      echo $output;
  
      }    
  // jquery edit end

  public function delete(Request $request, $id){

    $Batch = Batch::find($id);

    $Batch->delete();

    return response()->json([ 'success' => 'Batch Delete Successfull']);

}

}

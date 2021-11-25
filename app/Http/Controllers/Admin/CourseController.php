<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Course;
use App\Models\Classes;
use App\Models\Day;
use App\Models\Batch;

class CourseController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::get();
      
        return view('Backend.Admin.Course.index' , $data);
    }

    public function create(){

        $data['Classes'] = Classes::get();
        $data['Days'] = Day::get();

        return view('Backend.Admin.Course.create' , $data);
    }

    public function store(Request $request){
       
        $validator = Validator::make($request->all(), [
            'Class' => 'required',
            'Batch' => 'required',
            'ClassType' => 'required',
            'StudentLimite' => 'required',
            'CourseFee' => 'required',
            'EnrollmentLastDate' => 'required',
            'CourseStatus' => 'required',       
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }
       
        //course time
         $start_time = $request->start_time.':00';
         $end_time = $request->end_time.':00';
        //course time end 

        //start time end time validation
        if($start_time > $end_time){
            $this->SetMessage('end time not smaller than start time ' , 'success');
            return redirect()->back();
        }
        //start time end time validation end

         //course days
            $CourseDays = $request->Course_days;
            $course_days = '';
            foreach($CourseDays as $row)
            {
                $course_days .= $row . ', ';
            }
            $course_days = substr($course_days, 0, -2);
        //course days end 

        try{
            
            $course = Course::create([
                'class'            => $request->Class,
                'batch'            => $request->Batch,
                'class_type'       => $request->ClassType,
                'student_limit'    => $request->StudentLimite,
                'course_fee'       => $request->CourseFee,
                'enrollment_last_date' => $request->EnrollmentLastDate,
                'status'           => $request->CourseStatus
                ]);

            $this->SetMessage('Course Create Successfull' , 'success');

            $data['courses'] = Course::get();
        
            $Array_Classes = array();
            foreach($data['courses'] as $courses){
                $Classes = Classes::select('id', 'name')->where('id' , $courses->class)->first();
                array_push($Array_Classes , $Classes);
            }
            $data['Classes'] = $Array_Classes;


            
            return redirect('/course');
            

        } catch (Exception $e){

            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }
        
    }

    // jquery view
    public function show(Request $request){
  
        $id = $request->course_id;
        if(isset($id))
         {  
              $output = '';    
              
              $course = Course::where('id', $id)->first();
              $Classe = Classes::select('name')->where('id' , $course->class)->first();
              $Batch = Batch::select('id', 'batch_name')->where('id' , $course->batch)->first();
              
              //class type
              if($course->class_type == 0){
                  $class_type = "Offline";
              }elseif($course->class_type == 1){
                  $class_type = "Online";
              }
              
              //status
              if($course->status == 0){
                $class_status = "InActive";
              }elseif($course->status == 1){
                    $class_status = "Active";
              }
              
              //days
              $course_days = explode(',', $course->day);
             
              $output .= '  
              <div class="table-responsive">  
                   <table class="table table-bordered">';  
                   $output .= '  
                        <tr>  
                             <td width="30%"><label>ID</label></td>  
                             <td width="70%">'.$course->id.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Class</label></td>  
                             <td width="70%">'.$Classe->name.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Batch</label></td>  
                             <td width="70%">'.$Batch->batch_name.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Class Type</label></td>  
                             <td width="70%">'.$class_type.'</td>  
                        </tr>

                        <tr>  
                             <td width="30%"><label>Student Limit</label></td>  
                             <td width="70%">'.$course->student_limit.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Course Fee</label></td>  
                             <td width="70%">'.$course->course_fee.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Enrollment Last Date</label></td>  
                             <td width="70%">'.$course->enrollment_last_date.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Status</label></td>  
                             <td width="70%">'.$class_status.'</td>  
                        </tr>
                        <tr>  
                             
                        ';   
              $output .= "</table></div>";      

              echo $output;  
//              return response()->json([ 'output' => $output]);
         }
    }

    public function edit(Request $request){

        $id = $request->id;

        $data['course'] = Course::find($id);
        $data['Classes'] = Classes::get();
        $data['Days'] = Day::get();

        $data['course_days'] = explode(',', $data['course']->day);
       // dd($data['course_days']);
                                                   
        return view('Backend.Admin.Course.edit' , $data);
    }

    public function update(Request $request){
      
        $validator = Validator::make($request->all(), [
            'Class' => 'required',
            'Batch' => 'required',
            'ClassType' => 'required',
            'StudentLimite' => 'required',
            'CourseFee' => 'required',
            'EnrollmentLastDate' => 'required',
            'CourseStatus' => 'required',       
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }
        
        //start time end time validation
        if($request->start_time > $request->end_time){
            $this->SetMessage('end time not smaller than start time ' , 'success');
            return redirect()->back();
        }
        //start time end time validation end

         //course days
            $CourseDays = $request->Course_days;
            $course_days = '';
            foreach($CourseDays as $row)
            {
                $course_days .= $row . ', ';
            }
            $course_days = substr($course_days, 0, -2);
        //course days end 

        try{

            $id = $request->id;

            $course = Course::find($id);
            $course->class            = $request->Class;
            $course->batch            = $request->Batch;
            $course->class_type       = $request->ClassType;
            $course->student_limit    = $request->StudentLimite;
            $course->course_fee       = $request->CourseFee;
            $course->enrollment_last_date = $request->EnrollmentLastDate;
            $course->status           = $request->CourseStatus;
            $course->save();
           
            $this->SetMessage('Course Update Successfull' , 'success');

            $data['courses'] = Course::get();
        
            
            return redirect('/course')->with($data);
            
        
        } catch (Exception $e){
            
            $this->SetMessage($e->getMessage() , 'danger');

            return redirect()->back();
         }
        
    }


    public function status_change(Request $request, $id){
        try{

            $id = $request->id;
            
            //update offer_Course table
            $course = Course::find($id);

            if($request->value == "Active"){
                $course->status = 0;
            }elseif($request->value == "InActive"){
                $course->status = 1;
            }
            
            $course->save();
         
            return response()->json([ 'success' => 'Course Status Change Successfull']);
            
        
        } catch (Exception $e){
            return response()->json([ 'error' => 'something wrong.... course is not verifyed']);
         }

     }

     public function delete(Request $request, $id){
                  
        $Course = Course::find($id);

        $Course->delete();

        return response()->json([ 'success' => 'Course Delete Successfull']);

     }


     public function dynamic_batch_select(Request $request){

        
        $Classes = Classes::select('id', 'name')->get();

        if($request->action == "Class_Select"){
            $Batchs = Batch::select('id' , 'batch_name' , 'class_id')->where('class_id' , $request->class_id)->get();
       
            $output = '<option value="">Choose One Batch</option>';
            foreach($Batchs as $Batch){
                $output .= '<option  id="'.$Batch->id.'" value="'.$Batch->id.'">'.$Batch->batch_name.'</option>';
            }
        }elseif ($request->action == "Class_Edit") {
            $offer_course = Course::select('id', 'class', 'batch')->where('id' , $request->offer_course_id)->first();
            $Batchs = Batch::select('id' , 'batch_name' , 'class_id')->where('class_id' , $request->class_id)->get();
           
            $output = '<option value="">Choose One Batch</option>';
          
            foreach($Batchs as $Batch){
                if($offer_course->batch == $Batch->id){
                    $output .= '<option  id="'.$Batch->id.'" value="'.$Batch->id.'" selected>'.$Batch->batch_name.'</option>';
                }else{
                    $output .= '<option  id="'.$Batch->id.'" value="'.$Batch->id.'" >'.$Batch->batch_name.'</option>';
                }
            }
        }
                  

        echo $output;

     }

}

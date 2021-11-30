<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPayment;
use App\Models\User;
use App\Models\User_Academic_Info;
use App\Models\Student_Course_Enrollment;
use PDF;

class MoneyReceiptPdfController extends Controller
{
    public function receipt_download(Request $request)
    {
        $id = $request->id;

        $data['Student_Payment'] = StudentPayment::where('id' , $id)->first();
          
        $data['student'] = User::where('id', $data['Student_Payment'] ->user_id)->first();
        $data['student_academic_info'] = User_Academic_Info::select('user_designation','user_institute_address','user_institute_name')
                                                               ->where('user_id', $data['Student_Payment'] ->user_id)
                                                               ->first();
     
         
        $data['Paid_Amount'] =  $data['Student_Payment'] ->payment_amount;

        $Student_Payments = StudentPayment::where('user_id',  $data['Student_Payment'] ->user_id)->get(); 
        $data['Total_Paid_Amount'] = 0;
        foreach ($Student_Payments as $StudentPayment) {
            $data['Total_Paid_Amount']  = $data['Total_Paid_Amount'] + $StudentPayment->payment_amount;
        }
        
        $Student_Enrolled_Courses = Student_Course_Enrollment::where('user_id', $StudentPayment->user_id)->get(); 
        $data['Total_Enroll_Course_Fee']  = 0;
        foreach ($Student_Enrolled_Courses as $Student_Enrolled_Course) {
          //  $Student_Enroll_Course_Fee = Course::select('course_fee')->where('id' , $Student_Enrolled_Course->course_id)->first();
          $data['Total_Enroll_Course_Fee'] = $data['Total_Enroll_Course_Fee'] + $Student_Enrolled_Course->negotiated_amount;
        }
          
        $pdf = PDF::loadView('Backend.Payment.money_receipt.student_payment_money_receipt_download' , $data)->setOptions(['isRemoteEnabled' => TRUE, 'enable_javascript' => TRUE, 'defaultFont' => 'time-new-roman' ,'isPhpEnabled' => true]);
    
        return $pdf->download('itsolutionstuff.pdf');

     
    }
}

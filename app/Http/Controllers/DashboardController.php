<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Type;
use App\Models\User_Info;
use App\Models\StudentPayment;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Classes;

class DashboardController extends Controller
{
    public function index()
    {   
        //students
        $data['User_Infos'] = User_Info::select('user_id' , 'verified_by' , 'user_type_id')->get();

        $data['Students']  = 0;

        foreach ($data['User_Infos'] as $User_Info) {
            $User_Type = User_Type::select('name')->where('id' , $User_Info->user_type_id)->first();

            if($User_Type->name == 'student' ){
                $data['Students']++;
            }
        }

        //students payment
        $data['StudentsPayment'] = StudentPayment::get();
        $data['StudentsPayments'] = 0;

        foreach ($data['StudentsPayment'] as $StudentsPayment) {
            $data['StudentsPayments'] = $data['StudentsPayments'] + $StudentsPayment->payment_amount;
        }

        //income
        $data['Income'] = Income::get();
        $data['Incomes'] = 0;

        foreach ($data['Income'] as $Income) {
            $data['Incomes'] = $data['Incomes'] + $Income->amount;
        }

        //expense
        $data['Expense'] = Expense::get();
        $data['Expenses'] = 0;

        foreach ($data['Expense'] as $Expense) {
            $data['Expenses'] = $data['Expenses'] + $Expense->amount;
        }

        return view('Dashboard.dashboard' , $data );
    }

    public function cancle()
    {
        return redirect()->back();
    }
}

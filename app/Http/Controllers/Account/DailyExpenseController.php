<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentPayment;

class DailyExpenseController extends Controller
{
    public function index()
    {
        $data['student_payment_infos'] = StudentPayment::get();

        return view('Backend.Account.index' , $data);
    }
}

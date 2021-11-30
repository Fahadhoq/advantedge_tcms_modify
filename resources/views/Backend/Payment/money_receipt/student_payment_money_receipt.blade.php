@extends('layouts.MasterDashboard')

@section('css')

<style> 
.text-danger strong {
    		color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #207cd4;
			border-top: 12px solid #207cd4;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #17ea68 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
        .company{
            float: left;
            width: 600px;
            overflow:auto;
           
        }
        .company h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0px 100px 7px 0;
		}
		.company p {
			font-size: 12px;
			margin: 0px;
		}
		.company p i {
			text-align: center;
			width: 18px;
		}

		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 30px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}

        .receipt_text{
            float: left;
            width: 650px;
            overflow:auto;
           
        }
        .receipt_text h1 {
			font-size: 20px;
			font-weight: bold;
			margin: 50px 200px 0px 50px;
		}


        .striped-border { 
            /* position: absolute; */
            border: 1px dashed #000; width: 100%;  margin-top: 5%; margin-bottom: 5px;
            z-index: 1;

         }

         .signature{
            float: left;
            width: 650px;
            /* overflow:auto; */
           
        }
        .signature h1 {
			font-size: 20px;
			font-weight: bold;
			margin: 100px 100px 100px 100px;
		}

</style>

@endsection

@section('container')

  <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                       
                        <!-- start page-title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4  class="page-title">STUDENT MONEY RECEIPT</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);"> MONEY RECEIPT</a></li>
                                        <li class="breadcrumb-item active">STUDENT  MONEY RECEIPT</li>
                                    </ol>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->

   
                 <div class="row">
                           

                     <!-- div 1 -->                                 
                        <div id="div1" class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
        
                                        
                                  
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->
                                    

                            <!-- 2nd row     -->
                           <div class="row">

                           <!-- money receipt  start -->
                            

                <div class="container">
                    <div class="row">
                        
                        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                            <div class="row">
                                <div class="receipt-header">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="receipt-left">
                                            <img class="img-responsive" alt="iamgurdeeposahan"  src="{{ 'storage/Logo/AdvantEdge_Logo.PNG' }}" style="width: 180px; border-radius: 43px;">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-left">
                                        <div class="company receipt">
                                            <h5>Advantedge Solutions Ltd</h5>
                                            <p>+8801771811844 <i class="fa fa-phone"></i></p>
                                            <p>advantedge@advantedge-solutions.net <i class="fa fa-envelope-o"></i></p>
                                            <p>Mohakhali, Dhaka. <i class="fa fa-location-arrow"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="receipt-header receipt-header-mid">
                                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                        <div class="receipt-right">
                                            <h5>{{$student->name}} <small>  |   ID : {{$student->id}}</small></h5>
                                            <p><b>Mobile :</b>{{$student->phone}}</p>
                                            <p><b>Email :</b> {{$student->email}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="receipt_text">
                                            <h1>Invoice# {{$Student_Payment->id}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-9">Payment Type</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i>@if($Student_Payment->payment_type == 1) Cashe
                                                                                                  @elseif($Student_Payment->payment_type == 2) BKash
                                                                                                  @elseif($Student_Payment->payment_type == 3) Rocket
                                                                                                  @elseif($Student_Payment->payment_type == 4) Cheque
                                                                                                  @elseif($Student_Payment->payment_type == 5) Other
                                                                                                  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Payment Mobile Number</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i> {{$Student_Payment->payment_mobile_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Payment Transaction Number</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i>{{$Student_Payment->payment_transaction_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Cheque Transit Number</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i>{{$Student_Payment->cheque_transit_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Remark</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i> {{$Student_Payment->payment_remark}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Recived BY</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i>
                                                          @php 
                                                                 $User = App\Models\User::select('name')->where('id' , $Student_Payment->receiver)->first();
                                                                 echo $User->name;
                                                          @endphp 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Payment Date</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i> {{$Student_Payment->payment_date}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                            <p>
                                                <strong>Total Amount: </strong>
                                            </p>
                                            <p>
                                                <strong>Payable Amount: </strong>
                                            </p>
                                            <p>
                                                <strong>Total Paid: </strong>
                                            </p>
                                            <p>
                                                <strong>Balance Due: </strong>
                                            </p>
                                            </td>
                                            <td>
                                            <p>
                                                <strong><i class="fa fa-inr"></i>
                                                            {{$Total_Enroll_Course_Fee}}
                                                </strong>
                                            </p>
                                            <p>
                                                <strong><i class="fa fa-inr"></i> {{$Paid_Amount}}</strong>
                                            </p>
                                            <p>
                                                <strong><i class="fa fa-inr"></i> {{$Total_Paid_Amount}}</strong>
                                            </p>
                                            <p>
                                                <strong><i class="fa fa-inr"></i>@php $Balance_Due = $Total_Enroll_Course_Fee - $Total_Paid_Amount; @endphp {{$Balance_Due}}</strong>
                                            </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row">
                                <div class="receipt-header receipt-header-mid receipt-footer">
                                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                        <div class="receipt-right">
                                            <p><b>Date :</b> @php echo date("Y/m/d"); @endphp</p>
                                            <h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="signature ">
                                            <hr class="striped-border">
                                            <h1>Signature</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>    
                    </div>
                </div>


                           <!-- money receipt  end -->
    

                            </div>  
                            <!-- 2nd row end                -->  

                            <div style=text-align:center class="col-xl-12">
                                         <!-- submit button    -->
                                         <a href="{{ route( 'student_payment.receipt_download' , $Student_Payment->id) }}" class="btn btn-success"> {{ __('Download') }}</a>
                                        <!-- button end -->
                                        
                                        </form> 
                                        <!-- from end -->

                                        <!-- cancle from -->
                                        <a href="{{ route( 'dashboard' ) }}" class="btn btn-danger"> {{ __('Dashboard') }}</a>
                                        <!-- cancle from end -->
                            <div> 
   

                                    </div>
                                </div>
                            </div> <!-- end col -->

                        

                    </div> <!-- end row -->      

                        
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

@endsection        

@section('jquery')
<!-- <script src="{{URL::to('assets/js/admin/Student_Enrollment/JsLocalSearch.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>  -->

<!------ money receipt  start  ----------> 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ money receipt  end  ----------> 

@endsection

@section('script')
<script>
$(document).ready(function(){

//student course detials show start

// var url = '/student-payment-student-course-detials-show-';   
// var SearchStudent = $("#student_id").text();
// // console.log(SearchStudent);
// var csrf_token = $('input[name=_token]').val();

// $.ajaxSetup({
//           headers: {
//                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
//                   }
//       });

// $.ajax({
//       url: url+SearchStudent,
//       type: 'post',
//       data:{
//           SearchStudent : SearchStudent,
//               "_token": "{{ csrf_token() }}"
//            },
                  
//               success:function(data)
//               {
//                   $('#StudentCourdsdetail').html(data);
//                  // $('#student_id').val(data.id);
//                 // console.log(data);
//               }
//  });

//student course detials show end


});    
          
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

	<style>
        .text-danger strong {
    		color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #207cd4;
			border-top: 12px solid #17ea68;
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
		.receipt-footer {
			font-size: 15px;
			font-weight: 400 !important;
		}
		.receipt-footer h1 {
			font-size: 20px;
			font-weight: bold;
			margin: 0px 0px 0px 350px;
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
		.receipt-right h1 {
			font-size: 14px;
			font-weight: bold;
			margin: 0 0 0px 380px;
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
			margin: 34px 0 0 200px;
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

    </style>

</head>

<body>

<div class="container">	
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">

					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
									<div class="receipt-left">
											<h5>{{$student->name}} <small>  |   ID : {{$student->id}}</small></h5>
												<p><b>Mobile :</b>{{$student->phone}}</p>
												<p><b>Email :</b> {{$student->email}}</p>
									</div>
					</div>
					
					<div class="col-xs-4 col-sm-4 col-md-4">
					    <div class="receipt-right">
                            <h1> Invoice# {{$Student_Payment->id}} </h1>
                        </div>
					</div>

				</div>
            </div>
			
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Description</td>
                            <td> </td>
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
					
				    
					
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt">
                                    <h1>Signature</h1>
						</div>
					</div>

				</div>
            </div>


			
        </div>    
	</div>
    
</body>
</html>
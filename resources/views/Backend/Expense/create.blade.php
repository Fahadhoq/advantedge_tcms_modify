@extends('layouts.MasterDashboard')

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
                                    <h4  class="page-title">EXPENCE </h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">EXPENCE</a></li>
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
                                    
                           
                            <form action="{{ route( 'expense.create' ) }}" method="post"  enctype="multipart/form-data">
                                 @csrf

                            <!-- 2nd row     -->
                           <div class="row">

                           <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">

                                               <div class="form-group "> 
                                                    <label >GL Code</label>
                                                    <div >
                                                        <select class="form-control" name="ExpenseGLCode" id="ExpenseGLCode" value="{{ old('ExpenseGLCode') }}">
                                                           <option value="">Choose One GL Code</option>
                                                                @foreach($ExpenseGLCodes as $ExpenseGLCode)
                                                                    <option  id="{{$ExpenseGLCode->id}}" value="{{$ExpenseGLCode->id}}">{{$ExpenseGLCode->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                               </div>

                                               <div class="form-group">
                                                    <label>Amount</label>
                                                    <div>
                                                        <input type="text" id="ExpenseAmount" name="ExpenseAmount" value="{{ old('ExpenseAmount') }}"
                                                            class="form-control"
                                                            placeholder="Enter Expense Amount"/>    
                                                    </div>
                                                </div>
        
                                               <div class="form-group">
                                                    <label>Expense Date </label>
                                                    <div>
                                                        <input class="form-control" type="date" value="{{ old('ExpenseDate') }}" name="ExpenseDate" id="ExpenseDate">
                                                    </div>
                                                </div>

                                    </div>
                                    <!-- col-lg-6 -->
                                        </div>
                                        <!-- p-20    -->
                                    <!-- 1st part end     -->
                                   

                                    <!-- 2nd part              -->
                                        <div class="col-lg-6">
                                                <div class="p-20">

                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <div>
                                                        <input type="text" id="ExpenseRemark" name="ExpenseRemark" value="{{ old('ExpenseRemark') }}"
                                                            class="form-control"
                                                            placeholder="Enter Expense Remark"/>    
                                                    </div>
                                                </div>
                                            
                                                <div>   
                                                    <label for="image"> Money Receipt </label><br>
                                                    <input type="file" name="Money_Receipt_Image" class="form-control" id="Money_Receipt_Image"  placeholder="upload Image">
                                                </div>

                                            
                                            </div>
                                            <!-- col-lg-6 -->
                                        </div> 
                                        <!-- p-20 -->
                                    <!-- 2nd part end     -->    

                                 </div>  
                            <!-- 2nd row end                -->  
   
                                    <div style=text-align:center class="col-xl-12">
                                         <!-- submit button    -->
                                         <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                                        <!-- button end -->
                                        
                                        </form> 
                                        <!-- from end -->

                                        <!-- cancle from -->
                                        <a href="{{ route( 'user.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
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
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
@endsection

@section('script')
<script>
$(document).ready(function(){

    //dynamicly batch select
    $('#Class_Select').change(function(){
    
    if($(this).val() != '')
    {
        var action = $(this).attr("id");
        var class_id = $(this).val();
        var url = '/dynamic-batch-select-';
        var csrf_token = $('input[name=_token]').val();
        console.log(action);

        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

        $.ajax({
            url: url+class_id,
            type: 'post',
            data:{
                  class_id : class_id,
                  action : action,
                  "_token": "{{ csrf_token() }}"
                 },
            
            success:function (data) {
                $('#Batch').html(data);
             }

        });
    }

    });
    //dynamicly batch select

        
        //phone number validation   
        $('#phone').blur(function(){
          var $phone = $(this).val();
          var url = '/user-phone-number-availability-';
          if($phone != 0){
          var csrf_token = $('input[name=_token]').val();
  
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

          $.ajax({
            url: url+$phone,
            type: 'post',
            data:{
                  Number: $phone,
                  "_token": "{{ csrf_token() }}"
                 },
            
            success:function (data) {
              //console.log(html);
              $('#phone_number_availability').html(data);
            }

          });
  
        }      
        
        });
        //phone number validation end

        //email validation 
        $('#email').blur(function(){
          var $email = $(this).val();
          var url = '/email-availability-';
          if($email != 0){
          var csrf_token = $('input[name=_token]').val();
  
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

          $.ajax({
            url: url+$email,
            type: 'post',
            data:{
                  email: $email,
                  "_token": "{{ csrf_token() }}"
                 },
            
            success:function (data) {
              //console.log(html);
              $('#email_availability').html(data);
            }

          });
  
        }      
        
        }); 
         //email validation  end 

         //  multiselete
            $('#Course_days').multiselect({
                nonSelectedText: 'Select Coures Days',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'580px',
                
            });
        // multiselete end

});    
          
</script>
@endsection
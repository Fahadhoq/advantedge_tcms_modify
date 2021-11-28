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
                                    <h4  class="page-title">INCOME EDIT </h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">INCOME</a></li>
                                        <li class="breadcrumb-item active">INCOME EDIT</li>
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
                                    
                           
                            <form action="{{ route( 'income.edit' , $Income->id )  }}" method="post"  enctype="multipart/form-data">
                                 @csrf

                            <!-- 2nd row     -->
                           <div class="row">

                           <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">
                                        <input type="hidden" id="offer_course_id" value="{{$Income->id}}" />

                                               <div class="form-group "> 
                                               <label >GL Code</label>
                                                    <div >
                                                        <select class="form-control" name="IncomeGLCode" id="IncomeGLCode" value="{{ old('IncomeGLCode') }}">
                                                              <option value="">Choose One GL Code</option>
                                                                @foreach($IncomeGLCodes as $IncomeGLCode)
                                                                    @if($IncomeGLCode->id == $Income->gl_code_id)
                                                                       <option  id="{{$IncomeGLCode->id}}" value="{{$IncomeGLCode->id}}" selected>{{$IncomeGLCode->name}}</option>    
                                                                    @else
                                                                       <option  id="{{$IncomeGLCode->id}}" value="{{$IncomeGLCode->id}}">{{$IncomeGLCode->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                        </select>
                                                    </div>
                                               </div>

                                               <div class="form-group">
                                                    <label>Amount</label>
                                                    <div>
                                                        <input type="text" id="IncomeAmount" name="IncomeAmount" value="{{ $Income->amount }}" 
                                                            class="form-control"
                                                            placeholder="Enter Income Amount"/>    
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Income Date </label>
                                                    <div>
                                                        <input class="form-control" type="date" value="{{ $Income->income_date }}" name="IncomeDate" id="IncomeDate">
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
                                                        <input type="text" id="IncomeRemark" name="IncomeRemark" value="{{ $Income->remark }}"
                                                            class="form-control"
                                                            placeholder="Enter Income Remark"/>    
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                    
                                                    <label for="image"> Money Receipt </label><br>
                                                    <img src="{{url('storage').'/'.@$Income->money_receipt }}" id="view_uploading_img_src" width="445px" height="228px">  
                                                        
                                                    <button type="button" data-id="{{$Income->id}}" class="remove_button btn btn-danger">x</button>  
                                                

                                                    <div>
                                                        <input type="hidden" name="old_pic" value="{{ $Income->money_receipt }}"><br>    

                                                        <label for="image"> Want to change Image? </label><br>
                                                        <input type="file" name="Money_Receipt_Image" class="form-control" id="Money_Receipt_Image"  placeholder="upload Image">
                                                    </div>

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
                                        <a href="{{ route( 'income.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
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

// image edit show start

$("#Money_Receipt_Image").change(function () {
                  readImageURL(this);
               });

          function readImageURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#view_uploading_img_src').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

// image edit show start

//delete img
$(document).on('click', '.remove_button', function(){
   
   var id = $('.remove_button').data("id");
   var csrf_token = $('input[name=_token]').val();
  // console.log(id);
   var url = 'income-money-receipt-delete-'; 

    $.confirm({
               title: 'Confirm!!!',
               content: 'Are you sure you want to delete?',
               buttons: {
                   confirm: function () {
                       $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                   }
               });

                   $.ajax({
                   url: url + id,
                   type: 'post',
                   data: {
                               id: id,
                              "_token": "{{ csrf_token() }}"
                           },
                           
                   
                   success: function (result) {
                               if (result.error) {
                                   $.growl.error({message: result.error});
                               } else if (result.success) {
                                   
                                  //$.growl({ title: "Growl", message: result.success });
                                   $.growl.notice({message: result.success});
                                   location.reload();
                               }
                           }
                   });
                   return true;

                   },
                   cancel: function () {
                   }
               }

           });
       
});
//delete img end 

});    
          
</script>
@endsection
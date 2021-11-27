@extends('layouts.MasterDashboard')

@section('css')
<!-- datatable css link add -->
        <style>
            #filter_by_dropdown{
                margin-left : 900px; 
                /* pointer-events: all;
                position: absolute;
                z-index : 1; */
            }
        
        </style>
        @include('layouts.partials.datatable-css')
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
                        
                        <!-- start row -->
                        <div class="row align-items-center">
                            
                            <div class="col-sm-6">
                                <h4 class="page-title">ALL EXPENSES </h4>
                            </div>
                            
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                    <li class="breadcrumb-item active">EXPENSE </li>
                                    <li class="breadcrumb-item active">ALL EXPENSES </li>
                                </ol>
                            </div>
                       
                        </div>
                        <!-- end row -->
                     </div>
                    <!-- end page-title -->


                    <!-- main contaner start -->
               
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                
                                <div class="card-body">

                                 <!-- filter by dropdown -->
                                                <div class="form-group col-3" id="filter_by_dropdown">  
                                                    <div >
                                                        <select class="form-control" name="ExpenseGLCode" id="select_filter_by_dropdown" value="{{ old('ExpenseGLCode') }}">
                                                           <option value="null">Filter By GL Code</option>
                                                           <option value="all">Show all expense</option>
                                                                @foreach($ExpenseGLCodes as $ExpenseGLCode)
                                                                    <option  id="{{$ExpenseGLCode->id}}" value="{{$ExpenseGLCode->id}}">{{$ExpenseGLCode->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        <!-- filter by dropdown end         -->
                                  
                                    
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-default all_expense_show">
                                                    <tr>
                                                        <th style=text-align:center> SL</th>
                                                        <th style=text-align:center> ID</th>
                                                        <th style=text-align:center> Money Receipt</th>
                                                        <th style=text-align:center> GL Code</th>
                                                        <th style=text-align:center> Amount</th>
                                                        <th style=text-align:center> Remark</th>
                                                        <th style=text-align:center> Expense Date</th>
                                                        <th style=text-align:center> User Name</th>  
                                                        <th style=text-align:center> Action</th>  
                                                    </tr>
                                                </thead>
        
                                        <!-- all_expense_show div -->
                                                <tbody class="all_expense_show">
                                                @php $i=1 ; $total_expense_amount = 0 ;@endphp
                                                @foreach($Expenses as $Expense)
                                                    <tr>
                                                        <td style=text-align:center scope="row">{{$i++}}</td> 
                                                        <td style=text-align:center scope="row">{{$Expense->id}}</td>
                                                        <td style=text-align:center>
                                                            <img class="rounded-circle z-depth-2" width="60px" height="60px" src="{{ url('storage').'/'.@$Expense->money_receipt }}"
                                                            data-holder-rendered="true">
                                                        </td>
                                                        <td style=text-align:center>
                                                           @php  $ExpenseGLCode = App\Models\ExpenseGLCode::select('name')->where('id' , $Expense->gl_code_id)->first(); @endphp
                                                                {{$ExpenseGLCode->name}}
                                                        </td>
                                                        <td style=text-align:center>{{$Expense->amount}}</td>
                                                        @php $total_expense_amount = $total_expense_amount + $Expense->amount; @endphp
                                                        <td style=text-align:center>{{$Expense->remark}}</td>
                                                        <td style=text-align:center>{{$Expense->expense_date}}</td>
                                                        <td style=text-align:center>
                                                           @php  $User = App\Models\User::select('name')->where('id' , $Expense->gl_code_id)->first(); @endphp
                                                                {{$User->name}}
                                                        </td>

                    
                                                        <td style=text-align:center>
                                                            <!-- <a href="" class="btn btn-info btn-sm" title="View course"><i class="fa fa-eye"></i></a> -->
                                                            <!-- jquery view -->
                                                            <a  name="view" value="view" id="{{$Expense->id}}" class="btn btn-info btn-sm view_course" title="View course"><i class="fa fa-eye"></i></a>
                                                            <!-- jquery view end-->

                                                            <a href="{{ route('expense.edit' , $Expense->id) }}" class="btn btn-warning btn-sm" title="Edit Expense"><i class="fa fa-edit"></i></a>
                                                           
                                                          
                                                            <button class="btn btn-danger btn-sm delete" data-id="{{$Expense->id}}" value="{{$Expense->id}}"><i class="fa fa-trash"></i></button>         
                                                            <!-- <a href="" id="{{$Expense->id}}" class="btn btn-danger btn-sm remove" title="delete course" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a> -->
                                                          
                                                        </td> 
                                                    </tr>
                                                @endforeach  
                                                
                                                  <!-- total sum   -->
                                                  <tr>
                                                          <th style=text-align:right colspan="4">Total</th>
                                                          <th style=text-align:center;color:blue>{{$total_expense_amount}}</th>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                      </tr>
                                                    <!-- total sum end -->
                                                </tbody>
                                                <!-- all_expense_show div end -->

                                                <!-- Individual_expense_show div -->
                                               <thead class="thead-default Individual_expense_show_thead">
                                                    <tr>
                                                        <th style=text-align:center> SL</th>
                                                        <th style=text-align:center> ID</th>
                                                        <th style=text-align:center> Money Receipt</th>
                                                        <th style=text-align:center> GL Code</th>
                                                        <th style=text-align:center> Amount</th>
                                                        <th style=text-align:center> Remark</th>
                                                        <th style=text-align:center> Expense Date</th>
                                                        <th style=text-align:center> User Name</th>  
                                                        <th style=text-align:center> Action</th>  
                                                    </tr>
                                                </thead>

                                                <tbody class="Individual_expense_show">
                                                 
                                                </tbody>
                                                <!-- Individual_expense_show div end -->


                                    </table>

                                </div>

                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->


                    <!-- main  contaner end -->
                
                </div>
                <!-- container-fluid -->
            </div>
            <!-- content  -->
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->        

<!-- course view -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                
                <div class="modal-header">  
                     <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->  
                     <h4 class="modal-title">Course Details</h4>  
                </div>  
                
                <div class="modal-body" id="course_detail">  
                </div>  
                
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>
                  
           </div>  
      </div>  
 </div>
<!-- course view end -->

@endsection   


@section('jquery')
<!-- datatable js link add -->
@include('layouts.partials.datatable-js')
@endsection

@section('script')
<script>
//view expense
$(document).ready(function(){  

    $('.Individual_expense_show_thead').hide(); 

  
//filter
$(document).on('click', '#select_filter_by_dropdown', function(){ 
    var filter_type = $(this).val();


    if(filter_type == 'all' ){
        location.reload();

    } else if( filter_type != 'null' ) {
        var url = '/expense-index-filter-';
        var csrf_token = $('input[name=_token]').val();  

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $.ajax({  
                url: url + filter_type,  
                type: 'post',  
                data: {
                    filter_type : filter_type,
                    "_token": "{{ csrf_token() }}"
                    },  
                success:function(data){  
                        $('.all_expense_show').hide();

                        $('.Individual_expense_show').html(data);
                        $('.Individual_expense_show').show();
                        $('.Individual_expense_show_thead').show();      
                }  
        });
    }

});
//filter

     
    $(document).on('click', '.view_course', function(){
           var csrf_token = $('input[name=_token]').val();  
           var course_id = $(this).attr("id"); 
           console.log(course_id);
           var url = '/course-show-'; 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
          
           $.ajax({  
                url: url + course_id,  
                type: 'post',  
                data: {
                    course_id : course_id,
                       "_token": "{{ csrf_token() }}"
                      },  
                success:function(data){  
                    
                     $('#course_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });
 //view expense end      


// expense course 
    $('#datatable-buttons').delegate('.delete', 'click', function(){
    
        var csrf_token = $('input[name=_token]').val();
        var current_tr = $(this).closest('tr');
        var url = '/expense-delete-';
        var data_id = $(this).attr("data-id");
                
        console.log(data_id);

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
                        url: url + data_id,
                        type: 'post',
                        data: {
                                    id: data_id,
                                "_token": "{{ csrf_token() }}"
                                },
                                
                        
                        success: function (result) {
                                    if (result.error) {
                                        $.growl.error({message: result.error});
                                    } else if (result.success) {
                                        
                                    //$.growl({ title: "Growl", message: result.success });
                                        $.growl.notice({message: result.success});
                                        current_tr.remove();
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
    // delete expense end

});



</script>
@endsection
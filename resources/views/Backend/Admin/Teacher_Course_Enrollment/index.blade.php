@extends('layouts.MasterDashboard')

@section('css')
<!-- datatable css link add -->
        <style>
            #filter_by_dropdown{
                margin-left : 520px; 
                pointer-events: all;
                position: absolute;
                z-index : 1;
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
                            
                            <div class="col-sm-5">
                                <h4 class="page-title">ALL TEACHERS ENROLLMENT COURSES </h4>
                            </div>
                            
                            <div class="col-sm-7">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                    <li class="breadcrumb-item active">Coures Enrollment </li>
                                    <li class="breadcrumb-item active">Teacher Coure Enrollment </li>
                                    <li class="breadcrumb-item active">All Teachers Enrollment Coures</li>
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
                                                        <select class="form-control" name="" id="select_filter_by_dropdown">
                                                           <option value="0">Filter By </option>
                                                           <option value="1">All Enrollment courses </option>
                                                           <option value="2">Individual User </option>    
                                                        </select>
                                                    </div>
                                                </div>
                                        <!-- filter by dropdown end-->        
                                
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->
                                    

                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">           
                                                <thead class="thead-default all_enrollment_course_show">
                                                    <tr>
                                                        <th style=text-align:center> SL</th>
                                                        <th style=text-align:center> ID</th>
                                                        <th style=text-align:center> Teacher ID</th>
                                                        <th style=text-align:center> Teacher Name</th>
                                                        <th style=text-align:center> Course ID</th>
                                                        <th style=text-align:center> Course Name</th>
                                                        <th style=text-align:center> Status</th>    
                                                        <th style=text-align:center> Action</th>  
                                                    </tr>
                                                </thead>
        
                                          <!-- all_enrollment_course_show div -->
                                                <tbody class="all_enrollment_course_show">
                                                @php $i=1 @endphp
                                                @foreach($TeachersEnrollmentCourses as $TeachersEnrollmentCourse)
                                                    <tr>
                                                        <td style=text-align:center scope="row">{{$i++}}</td> 
                                                        <td style=text-align:center scope="row">{{$TeachersEnrollmentCourse->id}}</td>
                                                        
                                                        <!-- student info -->
                                                        <td style=text-align:center scope="row">{{$TeachersEnrollmentCourse->user->id}}</td>
                                                        <td style=text-align:center scope="row">{{$TeachersEnrollmentCourse->user->name}}</td>
                                                        <!-- student info end -->

                                                        <!-- course info -->
                                                        <td style=text-align:center scope="row">{{$TeachersEnrollmentCourse->course_id}}</td>
                                                             @php $course_classes = App\Models\Classes::select('name')->where('id' , $TeachersEnrollmentCourse->course->class)->get(); @endphp
                                                        <td style=text-align:center scope="row">@php foreach($course_classes as $course_class){ echo $course_class->name;  echo ', </br>'; } @endphp  </td>
                                                        <!-- course info end -->
                                                       
                                                         <!-- status -->
                                                         @if($TeachersEnrollmentCourse->status == 0)
                                                        <td style=text-align:center>
                                                            <button class="btn btn-danger btn-sm enrolled_course_status_change" data-id="{{$TeachersEnrollmentCourse->id}}" value="InActive">InActive</button>  
                                                        </td>
                                                        @elseif($TeachersEnrollmentCourse->status == 1)
                                                        <td style=text-align:center>
                                                            <button class="btn btn-success btn-sm enrolled_course_status_change" data-id="{{$TeachersEnrollmentCourse->id}}" value="Active">Active</button> 
                                                        </td>
                                                          @endif
                                                        <!-- status end  -->
                                                        
                                                        <td style=text-align:center>
                                                            <!-- <a href="" class="btn btn-info btn-sm" title="View course"><i class="fa fa-eye"></i></a> -->
                                                            <!-- jquery view -->
                                                            <a  name="view" value="view" id="{{$TeachersEnrollmentCourse->id}}" class="btn btn-info btn-sm view_enrolled_course" title="View enrolled course"><i class="fa fa-eye"></i></a>
                                                            <!-- jquery view end-->
         
                                                            @can('delete')
                                                            <button class="btn btn-danger btn-sm enrolled_course_drop" data-id="{{$TeachersEnrollmentCourse->id}}" value="{{$TeachersEnrollmentCourse->id}}" title="drop enrolled course"><i class="fa fa-trash"></i></button>         
                                                            <!-- <a href="" id="{{$TeachersEnrollmentCourse->id}}" class="btn btn-danger btn-sm remove" title="delete course" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a> -->
                                                            @endcan
                                                       
                                                        </td> 
                                                    </tr>
                                                @endforeach    
                                                </tbody>
                                                <!-- all_enrollment_course_show div end -->


                                               <!-- Individual_user_enrollment_courses_show div -->
                                               <thead class="thead-default individual_user_enrollment_courses_thead">
                                                    <tr>
                                                        <th style=text-align:center> SL</th>
                                                        <th style=text-align:center> Teacher ID</th>
                                                        <th style=text-align:center> Teacher Name</th>
                                                        <th style=text-align:center> Total Enrolled Courses </th>   
                                                        <th style=text-align:center> Action</th>  
                                                    </tr>
                                                </thead>

                                                <tbody class="individual_user_enrollment_courses_show">
                                                 
                                                </tbody>
                                                <!-- Individual_user_enrollment_courses_show div end -->


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

$(document).ready(function(){
    
    $('.individual_user_enrollment_courses_thead').hide(); 

  
    //filter
    $(document).on('click', '#select_filter_by_dropdown', function(){ 
        var filter_type = $(this).val();

        if(filter_type == 1){
            location.reload();

        } else if(filter_type == 2){
            var url = '/teacher-enrolled-course-index-filter-';
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
                            $('.all_enrollment_course_show').hide();

                            $('.individual_user_enrollment_courses_show').html(data);
                            $('.individual_user_enrollment_courses_show').show();
                            $('.individual_user_enrollment_courses_thead').show();      
                    }  
            });
        }

    });
    //filter
     

  // status  change 
$('#datatable-buttons').delegate('.enrolled_course_status_change', 'click', function(){
     
     var csrf_token = $('input[name=_token]').val();
     
     var url = '/teacher-enrolled-course-status-change-';
     var value = $(this).val();
     var enrolled_course_id = $(this).attr("data-id");
     
     $.confirm({
                 title: 'Confirm!!!',
                 content: 'Are you sure To change status this course?',
                 buttons: {
                     confirm: function () {
                         $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': "{{ csrf_token() }}"
                     }
                 });
                     
                 $.ajax({
                     url: url + enrolled_course_id,
                     type: 'post',
                     data: {
                                 enrolled_course_id : enrolled_course_id,
                                 value: value,
                                "_token": "{{ csrf_token() }}"
                             },
                             
                     
                     success: function (result) {
                                 if (result.error) {
                                     $.growl.error({message: result.error});
                                 } else if (result.success) {
                                     
                                     location.reload();
                                     $.growl.notice({message: result.success});
 
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
 //status  change end

    // drop enrolled course 
    $('#datatable-buttons').delegate('.enrolled_course_drop', 'click', function(){
    
        var csrf_token = $('input[name=_token]').val();
        var action = "individual_course_drop";
        var current_tr = $(this).closest('tr');
        var url = '/teacher-enrolled-course-drop-';
        var enrolled_course_id = $(this).attr("data-id");
                
       $.confirm({
                    title: 'Confirm!!!',
                    content: 'Are you sure you want to drop?',
                    buttons: {
                        confirm: function () {
                            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                        $.ajax({
                        url: url + enrolled_course_id,
                        type: 'post',
                        data: {
                                 enrolled_course_id: enrolled_course_id,
                                 action : action,
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
    // drop enrolled course end

});


</script>
@endsection
@extends('layouts.MasterDashboard')

@section('css')

<style> 
.mark {
  background-color: #d7ffe7 !important
}

.mark .gsearch{
  font-size: 20px
}

.unmark {
  background-color: #e8e8e8 !important
}

.unmark .gsearch{
  font-size: 10px
}

.marktext
{
 font-weight:bold;
 background-color: antiquewhite;
}
th {
    text-align:center
}
.selectRow
{
    background-color: #b2cdf7;
    color:black;
}
.course_table_head_tr{
  background-color: #f0f4f7;
  color:black;
}
.input_field_size{
    width: 80%;
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
                                    <h4  class="page-title">STUDENT ENROLLMENT </h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">STUDENT ENROLLMENT</a></li>
                                        <li class="breadcrumb-item active">ENROLL</li>
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
                                    
                           
                            <form action="" method="post" id="StudentCourseEnrollmentForm">
                                 @csrf

                            <!-- 2nd row     -->
                           <div class="row">

                           <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">
                                       
                                            <div class="form-group">
                                                <label>Search A Student </label>
                                                <div>
                                                    <input type="text" id="SearchStudent" name="SearchStudent"
                                                           class="form-control" 
                                                           placeholder="Enter Student Email Address Or ID"/>    
                                                </div>
                                            </div>

                                            <ul class="list-group">

                                            </ul>

                                            <div id="localSearchSimple"></div>

                                            <div id="detail" style="margin-top:16px;"></div>

                                    </div>
                                    <!-- col-lg-6 -->
                                        </div>
                                        <!-- p-20    -->
                                    <!-- 1st part end     -->
                                   

                                    <!-- 2nd part              -->
                                        <div class="col-lg-6">
                                                <div class="p-20">
                                                       <label>Offer Course List </label>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered ">
                                                      <thead>
                                                            <tr class="course_table_head_tr">
                                                                <th>Select</th>
                                                                <th>ID</th>
                                                                <th>Course Name</th>
                                                                <th>Subject Name</th>
                                                                <th>Day</th>
                                                                <th>Start Time</th>
                                                                <th>End Time</th>
                                                                <th>Class Type</th>
                                                                <th>Course Fee</th>
                                                                <th >Discount Amount</th>
                                                                <th >Negotiated Amount</th>
                                                                <th>Remark</th>
                                                                <th>Limit</th>
                                                                <th>Enrollment Last Date</th>  
                                                            </tr>
                                                      </thead>   
                                                       
                                                        @foreach($offer_courses as $offer_course)
                                                      
                                                            <tr>
                                                                <td align= "center">
                                                                    <input type="checkbox" id="{{$offer_course->id}}" class="select_course" value="{{ $offer_course->id }}" />
                                                                </td>
                                                                <td class="course_id" align= "center">{{ $offer_course->id }}</td>
                                                                <!-- class -->
                                                                <td align= "center">@php 
                                                                                      $class = App\Models\Classes::select('name')->where('id' , $offer_course->class)->first();
                                                                                         echo @$class->name;
                                                                                    @endphp</td>
                                                                <!-- class end -->
                                                                <!-- subject name -->
                                                                <td align= "center"> @php 
                                                                                      $subjects = App\Models\Subject::select('name')->where('class_id' , $offer_course->class)->get();
                                                                                        foreach($subjects as $subject){ echo @$subject->name; echo ',</br>';}
                                                                                      @endphp  
                                                                </td>
                                                                <!-- subject name end -->
                                                                <!-- day -->
                                                                <td align= "center">
                                                                                    @php 
                                                                                    $offer_course_days = explode(',', $offer_course->day);
                                                                                    $days = App\Models\Day::select('id' ,'name')->get();

                                                                                    foreach($days as $day){
                                                                                        $day_id = $day->id;
                                                                                          foreach($offer_course_days as $offer_course_day){
                                                                                            if($offer_course_day == $day_id){
                                                                                                echo $day->name;
                                                                                                echo '</br>';
                                                                                            }
                                                                                          }
                                                                                    }
                                                                                    @endphp
                                                                </td>
                                                                <!-- day end -->
                                                                <td align= "center">{{ date('h:i:s a', strtotime($offer_course->start_time)) }}</td>
                                                                <td align= "center">{{ date('h:i:s a', strtotime($offer_course->end_time)) }}</td>
                                                                <td align= "center">@if($offer_course->class_type == 0) Offline  @else Online @endif</td>
                                                                <td align= "center" id="course_fee_{{$offer_course->id}}">{{ $offer_course->course_fee }}</td>
                                                                <td align= "center"><input type="text"  class="input_field_size" id="Discount_input_field_{{$offer_course->id}}"  ></td>
                                                                <td align= "center"><input  class="input_field_size" id="negotiated_input_field_{{$offer_course->id}}" value="{{ $offer_course->course_fee }}"  readonly></td>
                                                                <td align= "center"><input  type="text"  id="Remark_{{$offer_course->id}}" ></td>
                                                                <td align= "center"> @php 
                                                                                         $enroll_course = App\Models\Student_Course_Enrollment::where('course_id' , $offer_course->id)->get();
                                                                                         $count_enroll_course = count($enroll_course);
                                                                                     @endphp 
                                                                                        {{ $count_enroll_course }} / {{ $offer_course->student_limit }}
                                                                </td>
                                                                <td align= "center">{{ date('d/m/y', strtotime($offer_course->enrollment_last_date)) }}</td>
                                                                
                                                            </tr>
                                                       
                                                        @endforeach

                                                    </table>
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
                                         <button type="button" id="StudentEnrolmentFormsubmit"  class="btn btn-primary">Submit</button>
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
<script src="{{URL::to('assets/js/admin/Student_Enrollment/JsLocalSearch.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>  
@endsection

@section('script')
<script>

$(document).ready(function(){
           
//Search Student by email or id
$('#SearchStudent').keyup(function(){
   
    var url = '/student-course-enrollment-student-search-';
    var SearchStudent = $("#SearchStudent").val();
    var csrf_token = $('input[name=_token]').val();

    $('#detail').html('');
    $('.list-group').css('display', 'block');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
        });

        $.ajax({
                    url: url+SearchStudent,
                    type: 'post',
                    data:{
                        SearchStudent : SearchStudent,
                        "_token": "{{ csrf_token() }}"
                        },
                    
                        success:function(data)
                        {
                            $('.list-group').html(data);
                        }
                });

     if(SearchStudent.length == 0){
        $('.list-group').css('display', 'none');
    }
   
});
//Search Student by email or id end


$('#localSearchSimple').jsLocalSearch({
  action:"Show",
  html_search:true,
  mark_text:"marktext"
});

//student detials show
 $(document).on('click', '.gsearch', function(){

  var url = '/student-course-enrollment-student-detials-show-';   
  var SearchStudent = $(this).text();
 // console.log(SearchStudent);
  $('#SearchStudent').val(SearchStudent);
  var csrf_token = $('input[name=_token]').val();
  $('.list-group').css('display', 'none');

  $.ajaxSetup({
            headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
        });

  $.ajax({
        url: url+SearchStudent,
        type: 'post',
        data:{
            SearchStudent : SearchStudent,
                "_token": "{{ csrf_token() }}"
             },
                    
                success:function(data)
                {
                    $('#detail').html(data);
                    $('#student_id').val(data.id);
                }
   });

  
});

$(document).on('click', '.gsearch_non', function(){ 
    $('.list-group').css('display', 'none');
    $('#detail').html('');
    $('#SearchStudent').val('');
});
//student detials show end

//select offer course
$('.select_course').click(function(){
    var value = $(this).val(); 
        if($(this).is(':checked'))
        {
            $(this).closest('tr').addClass('selectRow');
        }
        else
        {
            $(this).closest('tr').removeClass('selectRow');
        }
});
//select offer course end  

//check selected student is enrolled in selected course
$('.select_course').click(function(){
        if($(this).is(':checked')){

            var select_course_id =  $(this).val();
            var select_student_id =  $("#student_id").text();
            var csrf_token = $('input[name=_token]').val();
            var url = '/student-course-enrollment-check-student-is-enrolled-'; 
           // console.log(select_student_id);
            
            if(select_student_id != ''){
              
                $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                });

                $.ajax({
                        url: url + select_student_id,
                        type: 'post',
                        data:{
                            student_id : select_student_id,
                            course_id : select_course_id,
                                "_token": "{{ csrf_token() }}"
                            },
                                    
                                success : function(data)
                                {
                                    if(data.error) {
                                          $.growl.error({message: data.error});
                                          $('#'+select_course_id).closest('tr').removeClass('selectRow');
                                          $('#'+select_course_id).prop('checked', false);
                                          frontend_select_course_checkbox_value.splice($.inArray(select_course_id, frontend_select_course_checkbox_value),1);
                                        

                                    }else if (data.success){
                                        check_sit_limit(select_course_id);
                                       
                                    }
                                  // console.log(data);
                                }                
                });

            }else{
                        $.growl.error({message: "first select a student"});
                        $('.select_course').closest('tr').removeClass('selectRow');
                         $('.select_course').prop('checked', false);
            }
           
        }
});
//check selected student is enrolled in selected course end 

//check sit limit is full or not
function check_sit_limit(course_id) {

        if($('#'+course_id).is(':checked')){

            var course_id =  $('#'+course_id).val();
            var csrf_token = $('input[name=_token]').val();
            var url = '/student-course-enrollment-check-sit-limit-'; 
            
            if(course_id != null){
              
                $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                });

                $.ajax({
                        url: url + course_id,
                        type: 'post',
                        data:{
                            course_id : course_id,
                                "_token": "{{ csrf_token() }}"
                            },
                                    
                                success : function(data)
                                {
                                    if(data.error) {
                                          $.growl.error({message: data.error});
                                           $('#'+course_id).closest('tr').removeClass('selectRow');
                                           $('#'+course_id).prop('checked', false);
                                           frontend_select_course_checkbox_value.splice($.inArray(course_id, frontend_select_course_checkbox_value),1);
                                            
                                    } else if (data.success){
                                        backend_check_selected_course_is_clash_day_time(course_id);
                                       
                                    }
                                   
                                }                
                });

            }
           
        }
}
//check sit limit is full or not end  


//check selected course is clash (day,time) for student

//backend selected coures with db 
function backend_check_selected_course_is_clash_day_time(course_id) {
    
        if($('#'+course_id).is(':checked')){
            
            var select_course_id =  $('#'+course_id).val();
            var select_student_id =  $("#student_id").text();
            var csrf_token = $('input[name=_token]').val();
            var url = '/student-course-enrollment-check-student-course-is-clash-';
           
              
                $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                });

                $.ajax({
                        url: url + select_student_id,
                        type: 'post',
                        data:{
                            student_id : select_student_id,
                            course_id : select_course_id,
                                "_token": "{{ csrf_token() }}"
                            },
                                    
                                success : function(data)
                                {
                                    if(data.error) {
                                          $.growl.error({message: data.error});
                                           $('#'+select_course_id).closest('tr').removeClass('selectRow');
                                           $('#'+select_course_id).prop('checked', false);
                                           frontend_select_course_checkbox_value.splice($.inArray(select_course_id, frontend_select_course_checkbox_value),1);
                                          
                                    }
                                   
                                }                
                });
    
        }
}
//backend selected coures with db end

//forntend selected course
var frontend_select_course_checkbox_value = [];
$('.select_course').click(function(){
    
    var select_student_id =  $("#student_id").text();
    var csrf_token = $('input[name=_token]').val();
    var url = '/student-course-enrollment-check-selected-courses-is-clash';
    
    if ($(this).is(':checked')) {
        var forntend_select_course_id = ($(this).val());
        frontend_select_course_checkbox_value.push(forntend_select_course_id);
        var uncheck_request = 0;
    } else {
        var uncheck_course_id = ($(this).val());
        frontend_select_course_checkbox_value.splice($.inArray(uncheck_course_id, frontend_select_course_checkbox_value),1); //console.log("forntend uncheck"+frontend_select_course_checkbox_value);
        uncheck_request = 1;
    }

        if(uncheck_request == 0){
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            }
                    });

                    $.ajax({
                            url: url,
                            type: 'post',
                            data:{
                                student_id : select_student_id,
                                frontend_select_course_checkbox_value : frontend_select_course_checkbox_value,
                                    "_token": "{{ csrf_token() }}"
                                },
                                        
                                    success : function(data)
                                    {
                                        if(data.error) {
                                                $.growl.error({message: data.error});
                                                $('#'+forntend_select_course_id).closest('tr').removeClass('selectRow');
                                                $('#'+forntend_select_course_id).prop('checked', false);
                                                frontend_select_course_checkbox_value.splice($.inArray(forntend_select_course_id, frontend_select_course_checkbox_value),1);
                                              
                                        }
                                      
                                    }                
                    });
            }

});
//forntend selected course end

//check selected course is clash (day,time) for student end   

//calculate negotiated course fee

$('.select_course').click(function(){
    
    select_course_id = $(this).val(); 
    Discount_input_field_number = 'Discount_input_field_'+select_course_id;
    Negotiated_input_field_number = 'negotiated_input_field_'+select_course_id;
    selected_course_fee = 'course_fee_'+select_course_id;
    course_fee = $('#'+selected_course_fee).text();
    
        $('#'+Discount_input_field_number).keyup(function(){
            Discount_Amount = $(this).val();
            if(Discount_Amount != null){
               // if(Discount_Amount < course_fee){
                    Negotiated_Amount = course_fee - Discount_Amount ;
                    $('#'+Negotiated_input_field_number).val(Negotiated_Amount);
               // }else{
                    //$.growl.error({message: "Discount Amount is more than Coures Fee"});
                //}
            }
        });
}); 
//negotiated course fee end

//offer course store
var select_course_discount_amount_with_course_id_value = [];
var select_course_remark_with_course_id_value = [];
$("#StudentEnrolmentFormsubmit").click(function(){        
       // $("#myForm").submit(); // Submit the form
       var select_student =  $("#student_id").text();
       var select_course_checkbox = $('.select_course:checked');

       var csrf_token = $('input[name=_token]').val();
       var url = '/student-course-enrollment-store'; 
       //console.log(select_student);

        if(select_student.length != 0){

            if(select_course_checkbox.length > 0){
                var select_course_checkbox_value = [];
                $(select_course_checkbox).each(function(){
                    select_course_checkbox_value.push($(this).val());
                });


                jQuery.each(select_course_checkbox_value, function(i, CourseID) {
            //discount amount
                var select_course_discount_amount = $("#Discount_input_field_"+CourseID).val();
                    select_course_discount_amount_with_course_id = CourseID+'_'+select_course_discount_amount;
                    select_course_discount_amount_with_course_id_value.push(select_course_discount_amount_with_course_id);
            //discount amount end

            //Remark     
               var select_course_remark =  $("#Remark_"+CourseID).val();
               select_course_remark_with_course_id = CourseID+'_'+select_course_remark;
               select_course_remark_with_course_id_value.push(select_course_remark_with_course_id);
            //Remark end     
	  
               });

                $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                });

                $.ajax({
                        url: url,
                        type: 'post',
                        data:{
                            student_id : select_student,
                            select_course_ids : select_course_checkbox_value,
                            select_course_discount_amount_with_course_ids : select_course_discount_amount_with_course_id_value,
                            select_course_remark_with_course_ids : select_course_remark_with_course_id_value,

                                "_token": "{{ csrf_token() }}"
                            },
                                    
                                success : function(data)
                                {
                                    if(data.error) {
                                          $.growl.error({message: data.error});
                                    }else if(data.success){
                                    
                                        $.growl.notice({message: data.success});
                                        window.location.href = "/students-enrolled-courses";

                                    }
                                }
                                
                });
            
            }else{
                $.growl.error({message: "Select at least one course"});
            }

        }else{
            $.growl.error({message: "Select One Student"});
        }
        
    });
//offer course store end

});    
          
</script>
@endsection
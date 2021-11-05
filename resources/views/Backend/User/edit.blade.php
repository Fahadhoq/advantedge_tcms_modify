@extends('layouts.MasterDashboard')

@section('css')
  
  <style>
  .box
  {
   width:1010px;
   margin:0 auto;
   background-color:#FFFFFF;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  
.hide{
    display: none;
}

.heading{
    background-color: #F9F9F9;
    width:1012px;
    text-align: center;
    color: #30419B;
    font-size: 30px;
}
.has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
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
                                    <h4  class="page-title">USER EDIT </h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">USER</a></li>
                                        <li class="breadcrumb-item active">USER EDIT</li>
                                    </ol>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->

   
                 <!-- row 1        -->
                <div class="row">           

                     <!-- div 1 -->                                 
                        <div id="div1" class="col-lg-12">
                           
                        <!-- nav heading -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                        <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Login Details</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
                                </li>
                                @foreach($UserTypes as $UserType)
                                            @if( ($UserType->name == 'student') || ($UserType->name == 'Student') || ($UserType->name == 'STUDENT') )
                                                <li class="nav-item">
                                                        <a class="nav-link inactive_tab1" id="list_academic_details" style="border:1px solid #ccc">Academic Details</a>
                                                </li>
                                            @endif
                                @endforeach
                                
                            </ul>
                        <!-- nav heading end -->

                                <div class="card m-b-30">
                                    <div class="card-body">
                                 
                               
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->
                                    
                           
                            <form action="{{ route( 'user.edit' , $user->id ) }}" id="EditForm" method="post"  enctype="multipart/form-data">
                                 @csrf

                            <!-- ********************** login detials ********************************** -->

                            <!-- box -->
                            <div class="box">
                            <!-- 2nd row     -->
                            <div class="row show" id="login_details">
                                <div class="col-lg-12" >  
                                    <div class="heading">Login Details</div>
                                </div>        
                         
                           <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">
                                            
                                            </br>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div>
                                                    <input type="text" name="name" value="{{ $user->name }}"
                                                           class="form-control" required
                                                           placeholder="Enter User Name "/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Phone</label>
                                                <div>
                                                    <input type="text" name="phone" value="{{ $user->phone }}"
                                                           class="form-control" required
                                                           placeholder="Enter User Phone Number "/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <div>
                                                    <input type="text" name="email" value="{{ $user->email }}"
                                                           class="form-control" required
                                                           placeholder="Enter User Email "/>
                                                </div>
                                            </div>

                                            <div class="form-group "> 
                                                    <label >Select user type</label>
                                                    <div >
                                                        <select class="form-control" name="UserType" id="UserType" value="{{ old('UserType') }}">
                                                           <option value="">Choose one user type</option>
                                                           @foreach($user_types as $user_type)
                                                               <option  id="{{$user_type->id}}" value="{{$user_type->id}}"  @if ( $user_type->id == $User_Info->user_type_id ) selected @endif>{{$user_type->name}}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="form-group "> 
                                                    <label >Select user role</label>
                                                    <div >
                                                        <select class="form-control" name="UserRole" id="UserRole" value="{{ old('UserRole') }}">
                                                           <option value="">Choose one user role</option>
                                                           @foreach($roles as $role)
                                                               <option  id="{{$role->id}}" value="{{$role->id}}"  @if ( $role->id == $hasRole->role_id ) selected @endif>{{$role->name}}</option>
                                                           @endforeach
                                                        </select>
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
                                            
                                            </br>  
                                            <div class="form-group">
                                    
                                                <label for="image"> Image </label><br>
                                                <img src="{{url('storage').'/'.@$user->profile_photo_path }}" id="view_uploading_img_src" width="445px" height="228px">  
                                                       
                                                <button type="button" data-id="{{$user->id}}" class="remove_button btn btn-danger">x</button>  
                                              

                                                <div>
                                                    <input type="hidden" name="old_pic" value="{{ $user->profile_photo_path }}"><br>    

                                                    <label for="image"> Want to change Image? </label><br>
                                                    <input type="file" name="image" class="form-control" id="image"  placeholder="upload Image">
                                                </div>

                                            </div>


                                        </div>
                                         <!-- p-20 -->
                                             </div> 
                                             <!-- col-lg-6 -->
            
                                    <!-- 2nd part end     -->   

                                     <!-- button div -->
                                   <div style=text-align:center class="col-xl-12">
                                         <!-- next button    -->
                                         <button name="btn_login_details" id="btn_login_details" class="btn btn-info" type="button" class="btn btn-primary">Next</button>
                                        <!-- next end -->
                                        
                                        <!-- cancle from -->
                                        <a href="{{ route( 'user.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
                                        <!-- cancle from end -->
                                    </div> 
                                      <!-- button div  end-->
               
                                        </div>
                            <!-- 2nd row end                -->  
                                    </div> 
                                    <!-- box end -->


                            <!-- ********************** login detials end ********************************** -->

                             <!-- ********************** personal details  ********************************** -->

                            <!-- box -->
                            <div class="box">
                            <!-- 2nd row     -->
                            <div class="row hide" id="personal_details">
                                <div class="col-lg-12" >  
                                    <div class="heading">Personal Details</div>
                                </div>  
                    

                            <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">

                                            </br>
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <div>
                                                    <input type="text" name="FatherName" value="{{ $User_Info->father_name }}"
                                                            class="form-control" 
                                                            placeholder="Enter Your Father Name "/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Address</label>
                                                <div>
                                                    <input type="text" name="Address" value="{{ $User_Info->address }}"
                                                            class="form-control" 
                                                            placeholder="Enter Your Present Address "/>
                                                </div>
                                            </div>

                                            <div class="form-group "> 
                                                    <label >Gender</label>
                                                    <div >
                                                        <select class="form-control" name="UserGender" id="UserGender">
                                                              <option value="">Choose one gender </option>
                                                               <option value="1" @if ( $User_Info->gender == 1 ) selected @endif> Male </option> 
                                                               <option value="2" @if ( $User_Info->gender == 2 ) selected @endif> Female</option> 
                                                               <option value="3" @if ( $User_Info->gender == 3 ) selected @endif> Other</option> 
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="form-group "> 
                                                    <label >NID</label>
                                                    <div >
                                                    <input type="text" name="NidNumber" value="{{ $User_Info->nid_number }}"
                                                            class="form-control" 
                                                            placeholder="Enter Your NID Number "/>
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
                                            
                                            </br>
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <div>
                                                    <input type="text" name="MotherName" value="{{ $User_Info->mother_name }}"
                                                            class="form-control" 
                                                            placeholder="Enter Your Mother Name "/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Parent Phone Number</label>
                                                <div>
                                                    <input type="text" name="Parentphone" value="{{ $User_Info->parent_phone_number }}"
                                                            class="form-control" 
                                                            placeholder="Enter Your Parent Phone Number "/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div>
                                                    <input type="date" name="DateOfBirth" value="{{ $User_Info->date_of_birth }}" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="form-group "> 
                                                    <label >Religion</label>
                                                    <div >
                                                        <select class="form-control" name="Religion" id="Religion" >
                                                              <option value="">Choose one religion </option>
                                                               <option   value="1" @if ( $User_Info->religion == 1 ) selected @endif> Mulsim</option> 
                                                               <option   value="2" @if ( $User_Info->religion == 2 ) selected @endif> Hindu</option> 
                                                               <option   value="3" @if ( $User_Info->religion == 3 ) selected @endif> Buddhism</option> 
                                                               <option   value="4" @if ( $User_Info->religion == 4 ) selected @endif> Christianity</option>
                                                               <option   value="5" @if ( $User_Info->religion == 5 ) selected @endif> Other</option> 
                                                        </select>
                                                    </div>
                                            </div>

                                            
                                            </div>
                                            <!-- col-lg-6 -->
                                        </div> 
                                        <!-- p-20 -->
                                    <!-- 2nd part end     -->   
                                
                                   <!-- div button -->
                                    <div style=text-align:center class="col-xl-12">
                                        <!-- submit button    -->
                                        <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-warning">Previous</button>
                                        @foreach($UserTypes as $UserType)
                                            @if( ($UserType->name == 'student') || ($UserType->name == 'Student') || ($UserType->name == 'STUDENT') )
                                              <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info">Next</button>
                                            @else
                                              <button type="submit" id="submit"  class="btn btn-primary">Submit</button>
                                            @endif
                                        @endforeach
                                        
                                        <!-- button end -->
                                        
                                        <!-- cancle from -->
                                        <a href="{{ route( 'user.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
                                        <!-- cancle from end -->
                                    </div>  
                                    <!-- div button end  -->

                                </div>
                            <!-- 2nd row end                -->
                            </div> 
                            <!-- box end -->  


                            <!-- ********************** personal detials end ********************************** -->


                             <!-- ********************** academic details  ********************************** -->
                          
                             <!-- box -->
                            <div class="box">
                            <!-- 2nd row     -->
                            <div class="row hide" id="academic_details">
                                <div class="col-lg-12" >  
                                    <div class="heading">Academic Details</div>
                                </div>  
              
                            <!-- 1st part              -->
                                <div class="col-lg-6">
                                    <div class="p-20">
                                        
                                        </br>
                                        <div class="form-group "> 
                                                        <label >School / Collage / University</label>
                                                        <div >
                                                            <select class="form-control action" name="UserAcademicType" id="UserAcademicType" >
                                                                <option value="0">Choose any one </option>
                                                                @if($User_Academic_Info != null)
                                                                <option value="1"  @if ( $User_Academic_Info->user_academic_type == 1 ) selected @endif> School</option> 
                                                                <option value="2"  @if ( $User_Academic_Info->user_academic_type == 2 ) selected @endif> Collage</option> 
                                                                <option value="3"  @if ( $User_Academic_Info->user_academic_type == 3 ) selected @endif> University</option> 
                                                                <option value="4"  @if ( $User_Academic_Info->user_academic_type == 4 ) selected @endif> Other</option> 
                                                                @else
                                                                <option value="1" > School</option> 
                                                                <option value="2" > Collage</option> 
                                                                <option value="3" > University</option> 
                                                                <option value="4" > Other</option> 
                                                                @endif
                                                            </select>
                                                        </div>
                                        </div>

                                        <div class="form-group "> 
                                                        <label >Class</label>
                                                        <div >
                                                            <select class="form-control UserClass" name="UserClass" id="UserClass" >
                                                                <option value="0">Choose any one </option>        
                                                            </select>
                                                            <span id="error_class" class="text-danger"></span>
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
                                            
                                            </br>
                                            <div class="form-group">
                                                <label>Institute Name</label>
                                                <div>
                                                    <input type="text" name="UserInstituteName" @if($User_Academic_Info != null) value="{{ $User_Academic_Info->user_institute_name }}" @endif
                                                            class="form-control"
                                                            placeholder="Enter User Institute Name"/>
                                                </div>
                                            </div>

                                            
                                            </div>
                                            <!-- col-lg-6 -->
                                        </div> 
                                        <!-- p-20 -->
                                    <!-- 2nd part end     -->   
                                
                                  <!-- button div -->
                                    <div style=text-align:center class="col-xl-12">
                                        <!-- submit button    -->
                                        <button type="button" name="previous_btn_academic_details" id="previous_btn_academic_details" class="btn btn-warning">Previous</button>
                                        <!-- <button type="button" name="btn_academic_details" id="btn_academic_details" class="btn btn-success btn-lg">Register</button> -->
                                        <button type="submit" id="submit"  class="btn btn-primary">Submit</button>
                                        <!-- button end -->
                                        
                                        </form> 
                                        <!-- from end -->

                                        <!-- cancle from -->
                                        <a href="{{ route( 'user.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
                                        <!-- cancle from end -->
                                    </div> 
                                    <!-- button div end   -->

                                </div> 
         
                            <!-- 2nd row end                -->  
                            </div> 
                            <!-- box end --> 


                            <!-- ********************** contact detials end ********************************** -->
   
                                    
                                        
                           

                                     </div>  <!-- end card-body -->
                                 </div> <!-- end card-m-b-30 -->
                         
                            </div> <!-- end div 1 --> 

                        

                        </div> <!-- end row 1-->      

                        
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

@endsection  
 

@section('script')

<script>

// image edit show start

            $("#image").change(function () {
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
    var url = 'user-image-delete-'; 

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

$(document).ready(function(){
 
 //multi step user edit
 $('#btn_login_details').click(function(){
    
    $('#list_login_details').removeClass('active active_tab1');
    $('#list_login_details').removeAttr('href data-toggle');
    $('#login_details').removeClass('show');
    $('#login_details').addClass('hide');
    $('#list_login_details').addClass('inactive_tab1');
    $('#list_personal_details').removeClass('inactive_tab1');
    $('#list_personal_details').addClass('active_tab1 active');
    $('#list_personal_details').attr('href', '#personal_details');
    $('#list_personal_details').attr('data-toggle', 'tab');
    $('#personal_details').removeClass('hide');
    $('#personal_details').addClass('show');
 });
 
 $('#previous_btn_personal_details').click(function(){

    $('#list_personal_details').removeClass('active active_tab1');
    $('#list_personal_details').removeAttr('href data-toggle');
    $('#personal_details').removeClass('show');
    $('#personal_details').addClass('hide');
    $('#list_personal_details').addClass('inactive_tab1');
    $('#list_login_details').removeClass('inactive_tab1');
    $('#list_login_details').addClass('active_tab1 active');
    $('#list_login_details').attr('href', '#login_details');
    $('#list_login_details').attr('data-toggle', 'tab');
    $('#login_details').removeClass('hide');
    $('#login_details').addClass('show');
 
});
 
 $('#btn_personal_details').click(function(){

    $('#list_personal_details').removeClass('active active_tab1');
    $('#list_personal_details').removeAttr('href data-toggle');
    $('#personal_details').removeClass('show');
    $('#personal_details').addClass('hide');
    $('#list_personal_details').addClass('inactive_tab1');
    $('#list_academic_details').removeClass('inactive_tab1');
    $('#list_academic_details').addClass('active_tab1 active');
    $('#list_academic_details').attr('href', '#academic_details');
    $('#list_academic_details').attr('data-toggle', 'tab');
    $('#academic_details').removeClass('hide');
    $('#academic_details').addClass('show');
  
 });
 
 $('#previous_btn_academic_details').click(function(){

    $('#list_academic_details').removeClass('active active_tab1');
    $('#list_academic_details').addClass('inactive_tab1');
    $('#list_academic_details').removeAttr('href data-toggle');
    $('#academic_details').removeClass('show');
    $('#academic_details').addClass('hide');
    $('#list_personal_details').removeClass('inactive_tab1');
    $('#list_personal_details').addClass('active_tab1 active');
    $('#list_personal_details').attr('href', '#personal_details');
    $('#list_personal_details').attr('data-toggle', 'tab');
    $('#personal_details').removeClass('hide');
    $('#personal_details').addClass('show');

 });
//multi step user edit end 

// school/collage/university selected
        var csrf_token = $('input[name=_token]').val();
        var user_id = $('.remove_button').data("id"); 
        var UserAcademicType = $('.action').attr("id");
        var user_academic_type_id = $('.action').val();
        //console.log(user_id);
        var result_id = '';
        var url = 'dynamicly-user-class-select-'; 

        if(UserAcademicType == "UserAcademicType")
        {
            action = "Selected_Class_Show";
            result_id = 'UserClass';
        }

        $.ajax({
            url: url + user_academic_type_id,
            type: 'post',
            data: {
                    action : action, 
                    user_id : user_id,
                    user_academic_type_id : user_academic_type_id,
                    "_token": "{{ csrf_token() }}"
                },
                    
            success: function (result) {
                         $('#'+result_id).html(result);
                    }
                    
                });
//school/collage/university selected end

//dynamicly school/collage/university select
$('.action').change(function(){
 
        var csrf_token = $('input[name=_token]').val(); 
        var UserAcademicType = $(this).attr("id");
        var user_academic_type_id = $(this).val();
       // console.log(user_academic_type_id);
        var result_id = '';
        var url = 'dynamicly-user-class-select-'; 

        if(UserAcademicType == "UserAcademicType")
        {   
            action = "All_Class_Show";
            result_id = 'UserClass';
        }

        $.ajax({
            url: url + user_academic_type_id,
            type: 'post',
            data: {
                    action : action, 
                    user_academic_type_id : user_academic_type_id,
                    "_token": "{{ csrf_token() }}"
                },
                    
            success: function (result) {
                         $('#'+result_id).html(result);
                    }
                    
                });   

});
//dynamicly school/collage/university select end

//user class validation
    
$('.action').change(function(){
        var error_class = '';
        var action = $(this).attr("id");
        var user_academic_type_id = $(this).val();
    
        if((action == "UserAcademicType") && (user_academic_type_id != 0)){
    
                var user_class_id = $('#UserClass').val();
            
                if(user_class_id == 0){       
                        error_class = 'class is required';
                        $('#error_class').text(error_class);
                        $('#UserClass').addClass('has-error');
                    
                        $('#UserClass').change(function(){
                            var class_id = $(this).val();
                           // console.log(class_id);
                            if(class_id != 0){ 
                                error_class = '';
                                $('#error_class').text(error_class);
                                $('#UserClass').removeClass('has-error');
                            }else{
                                error_class = 'class is required';
                                $('#error_class').text(error_class);
                                $('#UserClass').addClass('has-error');
                            }

                         });
                }
            
        }
    
    });
    
//user class validation end

});


</script>

@endsection

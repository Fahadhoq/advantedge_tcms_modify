        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span>
                            </a>
                        </li>

                        
                        @role('admin')
                        <!-- ROLE start-->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> ROLE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('roles.index') }}"> {{ __('Show All Roles') }}</a></li>
                                <li><a href="{{ route('roles.create') }}"> {{ __('Role Create') }}</a></li>
                            </ul>
                        </li>
                        <!-- Role end -->
                        
                        <!-- Permission start-->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> PERMISSION <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('permission.index') }}"> {{ __('Show All Permissions') }}</a></li>
                                <li><a href="{{ route('permission.create') }}"> {{ __('Permission Create') }}</a></li>
                            </ul>
                        </li>
                        <!-- Permission end -->

                        <!-- User Type start-->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> USER TYPE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('UserType.index') }}"> {{ __('Show All User Type') }}</a></li>
                                <li><a href="{{ route('UserType.create') }}"> {{ __('Create User Type') }}</a></li>
                            </ul>
                        </li>
                        <!-- User Type end -->

                       <!-- offer Course start-->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> COURSE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                               
                                <!-- Class/course start-->
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> COURSE CREATE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('class.index') }}"> {{ __('Show All Course') }}</a></li>
                                        <li><a href="{{ route('class.create') }}"> {{ __('Create Course ') }}</a></li>
                                    </ul>
                                </li>
                                <!-- Class/course end -->

                                 <!-- Batch start-->
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> BATCH <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('batch.index') }}"> {{ __('Show All Batch') }}</a></li>
                                        <li><a href="{{ route('batch.create') }}"> {{ __('Create Batch') }}</a></li>
                                    </ul>
                                </li>
                                <!-- Batch end -->

                                 <!-- offer Course start-->
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> OFFER COURSE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('course.index') }}"> {{ __('Show All Course') }}</a></li>
                                        <li><a href="{{ route('course.create') }}"> {{ __('Offer Course ') }}</a></li>
                                    </ul>
                                </li>
                                <!-- offer Course end -->

                            </ul>
                        </li>
                       <!-- offer Course end -->

                        <!-- user start -->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> USER <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('user.index') }}"> {{ __('Show All Users') }}</a></li>
                                <li><a href="{{ route('user.create') }}"> {{ __('Create User') }}</a></li>
                                
                            </ul>
                        </li>
                        <!-- user end -->
                       
                        @endrole

                         <!-- student Registration start -->
                         <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> STUDENT/CUSTOMER  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('student.index') }}"> {{ __('Show All Students') }}</a></li>
                                <li><a href="{{ route('student.create') }}"> {{ __('Create Student/Customer') }}</a></li>
                                
                            </ul>
                        </li>
                        <!-- student Registration end -->

                        <!-- Student Course Enrollment start -->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> STUDENT ENROLLMENT <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                        <li><a href="{{ route('StudentCourseEnrollment.enroll') }}">enroll</a></li>
                                        <li><a href="{{ route('StudentCourseEnrollment.index') }}">all enrolled courses</a></li>    
                            </ul>
                        </li>
                        <!-- Student Course Enrollment end -->

                        <!-- Assign Teacher in Course  start -->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> ASSING TEACHER <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                        <li><a href="{{ route('TeacherCourseEnrollment.enroll') }}">assign</a></li>
                                        <li><a href="{{ route('TeacherCourseEnrollment.index') }}">all assigned teachers</a></li>    
                            </ul>
                        </li>
                        <!-- Assign Teacher in Course end -->

                        <!-- Enrollment start -->
                        <!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> COURSE ENROLLMENT <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li>
                                    <a href="javascript:void(0);">Student Course Enrollment <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('StudentCourseEnrollment.enroll') }}">enroll course</a></li>
                                        <li><a href="{{ route('StudentCourseEnrollment.index') }}">all enrolled courses</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript:void(0);">Teacher Course Enrollment <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('TeacherCourseEnrollment.enroll') }}">enroll course</a></li>
                                        <li><a href="{{ route('TeacherCourseEnrollment.index') }}">all enrolled courses</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        <!-- Enrollment end -->

                        <!-- payment start -->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> STUDENT FEE <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('StudentPayment.pay') }}">pay</a></li>
                                        <li><a href="{{ route('StudentsPayment.index') }}">show all students Fee</a></li>
                                    </ul>
                        </li>
                        <!-- payment end -->
                        
                        <!-- account start -->
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> ACCOUNT <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <!-- daily expense start-->
                                <li>
                                    <a href="javascript:void(0);"> EXPENCE  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('daily_expense.index') }}">Daily Expense</a></li>
                                        <li><a href="{{ route('daily_expense.index') }}">All Expense</a></li>
                                    </ul>
                                </li>
                                <!-- daily expense end -->

                                <!-- daily recive start-->
                                <li>
                                    <a href="javascript:void(0);"> RECEIVE   <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0);">Daily Receive</a></li>
                                        <li><a href="javascript:void(0);">All Receive</a></li>
                                    </ul>
                                </li>
                                <!-- daily recive end -->

                            </ul>
                        </li>
                        <!-- account end -->

                        
                        <li class="menu-title">Components</li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="ui-alerts.html">Alerts</a></li>
                                <li><a href="ui-badge.html">Badge</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-grid.html">Grid</a></li>
                            </ul>
                        </li>

                        
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> Multi Level <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="javascript:void(0);"> Menu 1</a></li>
                                <li>
                                    <a href="javascript:void(0);">Menu 2  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
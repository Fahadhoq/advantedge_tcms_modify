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
                        
                        <!-- start row -->
                        <div class="row align-items-center">
                            
                            <div class="col-sm-6">
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                            
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                       
                        </div>
                        <!-- end row -->
                     </div>
                    <!-- end page-title -->


                    <!-- main contaner start -->
               
                    <div class="row">

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-cube-outline bg-primary  text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Total Students</h5>
                                    </div>
                                    <h3 class="mt-4">{{$Students}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-briefcase-check bg-success text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Total Student Payment</h5>
                                    </div>
                                    <h3 class="mt-4">{{$StudentsPayments}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-tag-text-outline bg-warning text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Total Income</h5>
                                    </div>
                                    <h3 class="mt-4">{{$Incomes}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-heading p-4">
                                    <div class="mini-stat-icon float-right">
                                        <i class="mdi mdi-buffer bg-danger text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-16">Total expenses</h5>
                                    </div>
                                    <h3 class="mt-4">{{$Incomes}}</h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card m-b-30">
                                <div class="card-body">

                                    <h4 class="mt-0 header-title mb-4">Area Chart</h4>

                                    <div id="morris-area-example" class="morris-charts morris-chart-height"></div>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Donut Chart</h4>

                                    <div id="morris-donut-example" class="morris-charts morris-chart-height"></div>

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

@endsection        
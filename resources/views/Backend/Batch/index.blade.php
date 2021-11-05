@extends('layouts.MasterDashboard')

@section('css')
<!-- datatable css link add -->
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
                                <h4 class="page-title">ALL BATCHS </h4>
                            </div>
                            
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Training Center Management System</a></li>
                                    <li class="breadcrumb-item active">BATCH </li>
                                    <li class="breadcrumb-item active">ALL BATCHS </li>
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
                                  
                                    
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="thead-default">
                                                    <tr>
                                                        <th style=text-align:center>SL</th>
                                                        <th style=text-align:center>Course Name</th>
                                                        <th style=text-align:center>Batch Name</th>
                                                        <th style=text-align:center>Action</th>    
                                                    </tr>
                                                </thead>
        
        
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($batchs as $batch)
                                                    <tr>
                                                        <td style=text-align:center scope="row">{{$i++}}</td> 
                                                        <td style=text-align:center scope="row">{{$batch->class->name}}</td>   
                                                        <td style=text-align:center>{{$batch->batch_name}}</td>
                                            
                                                        <td style=text-align:center>
                                                            <!-- <a href="{{ route('batch.view' , $batch->id) }}" class="btn btn-info btn-sm" title="View batch"><i class="fa fa-eye"></i></a> -->
                                                            <!-- jquery view -->
                                                            <a  name="view" value="view" id="{{$batch->id}}" class="btn btn-info btn-sm view_batch" title="View batch"><i class="fa fa-eye"></i></a>
                                                            <!-- jquery view end-->

                                                            <!-- <a href="{{ route('batch.edit' , $batch->id) }}" class="btn btn-warning btn-sm" title="Edit batch"><i class="fa fa-edit"></i></a> -->
                                                            <!-- jquery edit -->  
                                                            <a  name="edit" value="Edit" id="{{$batch->id}}" class="btn btn-warning btn-sm edit_data" title="Edit batch"><i class="fa fa-edit"></i></a>
                                                            <!-- jquery edit end -->

                                                            @can('delete')
                                                            <button class="btn btn-danger btn-sm delete" data-id="{{$batch->id}}" value="{{$batch->id}}"><i
                                                            class="fa fa-trash"></i></button>         
                                                            <!-- <a href="{{ route('batch.delete' , $batch->id) }}" id="{{$batch->id}}" class="btn btn-danger btn-sm remove" title="delete batch" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a> -->
                                                            @endcan
                                                       
                                                        </td> 
                                                    </tr>
                                                @endforeach    
                                                </tbody>
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

<!-- class view -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                
                <div class="modal-header">  
                     <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->  
                     <h4 class="modal-title">Batch Details</h4>  
                </div>  
                
                <div class="modal-body" id="batch_detail">  
                </div>  
                
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>
                  
           </div>  
      </div>  
 </div>
<!-- class view end -->

<!-- edit table -->
<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
               
                <div class="modal-header">  
                     <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->  
                     <h4 class="modal-title">EDIT BATCH</h4>  
                </div>  
              
                <div class="modal-body">         
                <form id="insert_form">
                    @csrf 
                    <div id="batch_edit">  
                      
                    </div>     
                </form>  
                </div> 

                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  

           </div>  
      </div>  
 </div>
 <!-- edit table end -->

@endsection   


@section('jquery')
<!-- datatable js link add -->
@include('layouts.partials.datatable-js')
@endsection

@section('script')
<script>

$(document).ready(function(){  

 //view batch    
    $(document).on('click', '.view_batch', function(){
           var csrf_token = $('input[name=_token]').val();  
           var batch_id = $(this).attr("id"); 
           console.log(batch_id);
           var url = '/batch-show-'; 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
          
           $.ajax({  
                url: url + batch_id,  
                type: 'post',  
                data: {
                    batch_id : batch_id,
                       "_token": "{{ csrf_token() }}"
                      },  
                success:function(data){  
                    
                     $('#batch_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });
     //view batch end  

    // edit batch
    $(document).on('click', '.edit_data', function(){  
            var batch_id = $(this).attr("id");  
            var csrf_token = $('input[name=_token]').val();   
            var url = '/batch-edit-'; 
            console.log(batch_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

            $.ajax({  
                    url: url + batch_id,  
                    type: 'post',  
                    data: {
                        id : batch_id,
                        "_token": "{{ csrf_token() }}"
                        },    
                     
                    success:function(data){  
  
                        $('#add_data_Modal').modal('show');
                        $('#batch_edit').html(data);  
                        $('#insert').val("Update");
                      
                    }  
            });  
    });  
        
        $('#insert_form').on("submit", function(event){  
            event.preventDefault();  
            if($('#Batch_Name').val() == "")  
            {  
                    $.growl.error({message: "Name is required"});
                    //alert("Name is required");  
            }  
            else  
            {  
                var batch_id = $('#batch_id').val();
                var class_id = $('#Class').val();
                var Batch_Name = $('#Batch_Name').val();
                var csrf_token = $('input[name=_token]').val();
                var url = '/batch-update-';
                
                console.log(class_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({  
                        url: url + batch_id,  
                        type: 'post', 
                        // dataType: $('#insert_form').serialize(),
                        data : {
                        id : batch_id,
                        name : Batch_Name,
                        class_id : class_id,
                        "_token": "{{ csrf_token() }}"
                        }, 
                        beforeSend:function(){  
                            $('#insert').val("Inserting");  
                        },  
                        success:function(result){
                                if (result.error) {
                                        $.growl.error({message: result.error});
                                        $('#insert').val("Update");  
                                    } else if (result) {
                                        $('#insert_form')[0].reset();  
                                        $('#add_data_Modal').modal('hide');
                                        $('#dataModal').modal('hide');  
                                        $('#datatable-buttons').html(result);
                                        // console.log(result);
                                        $.growl.notice({message: "Batch Update successfully"});
                                        
                                    }    
                        }  
                    });  
            }  
        });  

    // edit subject end

    // delete subject 
    $('#datatable-buttons').delegate('.delete', 'click', function(){
    
        var csrf_token = $('input[name=_token]').val();
        var current_tr = $(this).closest('tr');
        var url = '/batch-delete-';
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
    // delete class end

});
//view class end



</script>
@endsection
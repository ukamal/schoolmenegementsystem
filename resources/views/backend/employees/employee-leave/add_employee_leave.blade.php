@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee Leave</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Leave</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    @if(isset($editData))
                                        Edit Employee Leave
                                    @else 
                                        Add Employee Leave
                                    @endif
                                    <a href="{{ route('employee-leave-view') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Employee List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                            <form action="{{ (@$editData)?route('employee-leave-update',$editData->id):route('employee-leave-store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="emloyee_id">Employee Leave</label>
                                        <select name="emloyee_id" id="emloyee_id" class="form-control form-control-sm">
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}" {{(@$editData->emloyee_id==$employee->id)?'selected':''}}>{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="date">Start Date</label>
                                        <input type="text" name="start_date" id="" value="{{@$editData->start_date}}" class="form-control form-control-sm singledatepicker" placeholder="Start Date" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="date">End Date</label>
                                        <input type="text" name="end_date" id="" value="{{@$editData->end_date}}" class="form-control form-control-sm singledatepicker" placeholder="End Date" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="leave_purpose_id">Leave Purpose</label>
                                        <select name="leave_purpose_id" id="leave_purpose_id" class="form-control form-control-sm">
                                            <option value="">Select Purpose</option>
                                            @foreach($leave_purpose as $leave)
                                            <option value="{{$leave->id}}" {{(@$editData->leave_purpose_id==$leave->id)?'selected':''}}>{{$leave->name}}</option>
                                            @endforeach
                                            <option value="0">New Purpose</option>
                                        </select>
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Write Purpose" id="add_other" style="display: none">
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top: 33px;">
                                        <button type="submit" class="btn btn-primary btn-sm">{{(@$editData)?'Update':'Submit'}}</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  

    <script>
        $(document).ready(function(){
            $(document).on('change','#leave_purpose_id',function(){
                var leave_purpose_id = $(this).val();
                if(leave_purpose_id == '0'){
                    $('#add_other').show();
                }else{
                    $('#add_other').hide();
                }
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules:{
                "emloyee_id" : { required: true, },
                "start_date" : { required: true, },
                "end_date" : { required: true, },
                "leave_purpose_id" : { required: true, }
            },
            message: {},
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>

@endsection
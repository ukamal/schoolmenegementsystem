@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee Attendance Report</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Attendance Report</li>
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
                                   Select Criteria
                                </h3>
                            </div>
                            <div class="card-body">
                               <form action="{{route('attendance-report-get')}}" method="get" id="myForm" target="_blank">
                                @csrf
                                    <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="employee_id">Employee</label>
                                        <select name="employee_id" id="employee_id" class="form-control select2bs4">
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employe)
                                                <option value="{{$employe->id}}">{{$employe->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                       <input type="text" name="date" id="date" class="form-control singledatepicker" autocomplete="off" placeholder="DD-MM-YYYY" readonly>
                                    </div>
                                    <div class="form-group col-md-3" style="margin-top: 35px;">
                                        <button type="submit" name="search" id="search" class="btn btn-primary form-control-sm" style="line-height: 10px;">Search</button>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#myForm').validate({
                rules:{
                    "employee_id" : { required: true, },
                    "date" : { required: true, }
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


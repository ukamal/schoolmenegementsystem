@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Marksheet Generate</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Marksheet</li>
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
                               <form action="{{route('student-marksheet-generator-get')}}" method="post" id="myForm" target="_blank">
                                @csrf
                                    <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="year_id">Year</label>
                                        <select name="year_id" id="year_id" class="form-control select2bs4">
                                            <option value="">Select Year</option>
                                            @foreach ($years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="class_id">Class</label>
                                        <select name="class_id" id="class_id" class="form-control select2bs4">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exam_type_id">Exam Type</label>
                                        <select name="exam_type_id" id="exam_type_id" class="form-control select2bs4">
                                            <option value="">Select Exam</option>
                                            @foreach ($exam_type as $exam)
                                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="id_no">Id No</label>
                                       <input type="text" name="id_no" id="id_no" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" name="search" id="search" class="btn btn-primary form-control form-control-sm" style="line-height: 10px;">Search</button>
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
                    "year_id" : { required: true, },
                    "class_id" : { required: true, },
                    "exam_type" : { required: true, },
                    "id_no" : { required: true, }
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


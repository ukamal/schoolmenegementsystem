@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student Exam Fee </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"> Student Exam Fee </li>
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
                                <h3> Search Criteria</h3>
                            </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group-col-md-3">
                                            <label>Year <font style="color: red">*</font></label>
                                            <select name="year_id" id="year_id" class="form-control form-control-sm">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="class">Class <font style="color: red">*</font></label>
                                            <select name="class_id" id="class_id" class="form-control form-control-sm">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exam">Exam <font style="color: red">*</font></label>
                                            <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm">
                                                <option value="">Select Exam Type</option>
                                                @foreach ($exams as $exam)
                                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" style="padding-top: 30px">
                                            <a id="search" name="search" class="btn btn-primary btn-sm">Search</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="DocumnetResults"></div>
                                    <script id="document-template" type="text/x-handlebars-template">
                                        <table class="table-sm table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    @{{{thsource}}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @{{#each this}}
                                                <tr>
                                                    @{{{tdsource}}}
                                                </tr>
                                                @{{/each}}
                                            </tbody>
                                        </table>
                                    </script>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        $(document).on('click','#search',function(){
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var exam_type_id = $('#exam_type_id').val();
            $('.notifyjs-corner').html('');
            if(year_id == ''){
                $.notify("Year required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(class_id == ''){
                $.notify("Class required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(exam_type_id == ''){
                $.notify("Exam required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{route('exam-fee-get-student')}}",
                type: "GET",
                data:{'year_id': year_id, 'class_id':class_id, 'exam_type_id':exam_type_id},
                beforeSend:function(){

                },
                success:function(data){
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumnetResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>


@endsection


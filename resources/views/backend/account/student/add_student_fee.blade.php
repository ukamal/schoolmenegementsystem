@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Student Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Fee</li>
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
                                   Add / Edit Student Fee
                                    
                                    <a href="{{ route('student-fee-view') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Student Fee List</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ (@$grades)? route('marks-grade-update',$grades->id) : route('marks-grade-store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="year_id">Select Year</label>
                                                <select name="year_id" id="year_id" class="form-control select2bs4">
                                                    <option value="">Select Year</option>
                                                    @foreach ($years as $year)
                                                        <option value="{{$year->id}}">{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="class_id">Select Class</label>
                                                <select name="class_id" id="class_id" class="form-control select2bs4">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="fee_category_id">Fee Category</label>
                                                <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                                                    <option value="">Select Fee Category</option>
                                                    @foreach ($fee_categories as $fee)
                                                        <option value="{{$fee->id}}">{{$fee->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="date">Date</label>
                                                <input type="text" name="date" id="date" class="form-control singledatepicker" placeholder="DD-MM-YYYY" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <a id="search" class="btn btn-primary" name="search">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <form action="{{route('student-fee-store')}}" method="post">
                                        @csrf 
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
                                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px">Submit</button>
                                    </form>
                                </script>
                            </div>
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
                    "grade_name" : {required : true},
                    "grade_point" : {required : true},
                    "start_marks" : {required : true},
                    "end_marks" : {required : true},
                    "start_point" : {required : true},
                    "end_point" : {required : true},
                    "remakrs" : {required : true}
                },
                message: {},
                errorElement: 'span',
                errorPlacement: function(error, element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight:function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element,errorClass,validClass){
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(document).on('click','#search',function(){
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var fee_category_id = $('#fee_category_id').val();
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if(year_id == ''){
                $.notify("Year required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(class_id == ''){
                $.notify("Class required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(fee_category_id == ''){
                $.notify("Fee Category required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(date == ''){
                $.notify("Date required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{route('accounts-fee-getstudent')}}",
                type: "get",
                data: {'year_id':year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
                beforeSend: function(){
                },
                success: function(data){
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>

@endsection
@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Student Grade</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Grade</li>
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
                                    @if (isset($grades))
                                        Edit Student Grade Point
                                    @else 
                                        Add Student Grade Point
                                    @endif
                                    
                                    <a href="{{ route('marks-grade-view') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Student Grade List</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ (@$grades)? route('marks-grade-update',$grades->id) : route('marks-grade-store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="grade_name">Grade Name</label>
                                                <input type="text" name="grade_name" id="grade_name" value="{{@$grades->grade_name}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="grade_point">Grade Point</label>
                                                <input type="text" name="grade_point" id="grade_point" value="{{@$grades->grade_point}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="start_marks">Start Mark</label>
                                                <input type="text" name="start_marks" id="start_marks" value="{{@$grades->start_marks}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="end_marks">End Mark</label>
                                                <input type="text" name="end_marks" id="end_marks" value="{{@$grades->end_marks}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="start_point">Start Point</label>
                                                <input type="text" name="start_point" id="start_point" value="{{@$grades->start_point}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="end_point">End Point</label>
                                                <input type="text" name="end_point" id="end_point" value="{{@$grades->end_point}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="remakrs">Remarks</label>
                                                <input type="text" name="remakrs" id="remakrs" value="{{@$grades->remakrs}}" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3" style="margin-top: 25px;">
                                                <button type="submit" class="btn btn-primary">{{(@$grades)?'Udated':'Submit'}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

@endsection
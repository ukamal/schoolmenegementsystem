@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Assign Subject</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Assign Subject</li>
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
                                    <a href="{{ route('view-assign-subject') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Assign Subject List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update-assign-subject',$allData['0']->class_id) }}" method="post" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="">Class</label>
                                                <select name="class_id" id="" class="form-control">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{$class->id}}" {{($allData['0']->class_id==$class->id)?"selected":""}}>{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @foreach ($allData as $item)
                                        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="">Subject</label>
                                                <select name="subject_id[]" id="" class="form-control">
                                                    <option value="">Select Subject</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{$subject->id}}" {{($item->subject_id==$subject->id)?"selected":""}}>{{$subject->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Full Mark</label>
                                                <input type="text" name="full_mark[]" class="form-control" value="{{$item->full_mark}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Pass Mark</label>
                                                <input type="text" name="pass_mark[]" class="form-control" value="{{$item->pass_mark}}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Subjective Mark</label>
                                                <input type="text" name="subjective_mark[]" class="form-control" value="{{$item->subjective_mark}}">
                                            </div>
                                            <div class="form-group col-md-2" style="padding-top: 30px">
                                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                                <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                            </div>
                                        </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="visibility: hidden">
                    <div class="whole_extra_item_add" id="whole_extra_item_add">
                        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="">Subject</label>
                                    <select name="subject_id[]" id="" class="form-control">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Full Mark</label>
                                    <input type="text" name="full_mark[]" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Pass Mark</label>
                                    <input type="text" name="pass_mark[]" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Subjective Mark</label>
                                    <input type="text" name="subjective_mark[]" class="form-control">
                                </div>
                                <div class="form-group col-md-2" style="padding-top: 30px">
                                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
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
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules:{
                "subject_id" : { required: true, },
                "class_id[]" : { required: true, },
                "full_mark[]" : { required: true, },
                "pass_mark[]" : { required: true, },
                "subjective_mark[]" : { required: true, }
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
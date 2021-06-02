@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student Registration</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Registration Form</li>
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
                                        Promotion Student
                                    @else 
                                        Add Student
                                    @endif
                                    <a href="{{ route('view-registration') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Registered Student List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('student-regi-promotion-store',$editData->student_id) }}" method="post" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$editData->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Student Name <font style="color: red">*</font></label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="{{@$editData['student']['name']}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Mobile">Mobile No <font style="color: red">*</font></label>
                                            <input type="text" name="mobile" value="{{ @$editData['student']['mobile'] }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father's name">Father's Name <font style="color: red">*</font></label>
                                            <input type="text" name="fname" value="{{@$editData['student']['fname']}}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Mother's Name">Mother's Name <font style="color: red">*</font></label>
                                            <input type="text" name="mname" value="{{ @$editData['student']['mname'] }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Address">Address <font style="color: red">*</font></label>
                                            <input type="text" name="address" value="{{ @$editData['student']['address'] }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                        <label for="Gender">Gender <font style="color: red">*</font></label>
                                        <select name="gender" id="gender" class="form-control form-control-sm">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{(@$editData['student']['gender']=='male')?'selected':''}}>Male</option>
                                            <option value="female" {{(@$editData['student']['gender']=='female')?'selected':''}}>Female</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="religion">Religion <font style="color: red">*</font></label>
                                            <select name="religion" id="religion" class="form-control form-control-sm">
                                                <option value="">Select Religion</option>
                                                <option value="Islam" {{(@$editData['student']['religion']=='Islam')?'selected':''}}>Islam</option>
                                                <option value="Hindu" {{(@$editData['student']['religion']=='Hindu')?'selected':''}}>Hindu</option>
                                                <option value="Krishtan" {{(@$editData['student']['religion']=='Krishtan')?'selected':''}}>Kristan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="dob">Date of Birth <font style="color: red">*</font></label>
                                            <input type="text" name="dob" value="{{ @$editData['student']['dob'] }}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="discount">Discount</label>
                                            <input type="text" name="discount" value="{{ @$editData['discount']['discount'] }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="year">Year <font style="color: red">*</font></label>
                                            <select name="year_id" id="year" class="form-control form-control-sm">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{$year->id}}" {{(@$editData->year_id==$year->id)?'selected':''}}>{{$year->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="class">Class <font style="color: red">*</font></label>
                                            <select name="class_id" id="class" class="form-control form-control-sm">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}" {{(@$editData->class_id==$class->id)?'selected':''}}>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group-col-md-4">
                                            <label for="group">Group</label>
                                            <select name="group_id" id="group" class="form-control form-control-sm">
                                                <option value="">Select Group</option>
                                                @foreach ($groups as $group )
                                                    <option value="{{$group->id}}" {{(@$editData->group_id==$group->id)?'selected':''}}>{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="shift">Shift</label>
                                            <select name="shift_id" id="shift" class="form-control form-control-sm">
                                                <option value="">Select Shift</option>
                                                @foreach ($shifts as $shift)
                                                    <option value="{{$shift->id}}" {{(@$editData->shift_id==$shift->id)?'selected':''}}>{{$shift->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group-col-md-4">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group-col-md-4">
                                            <img src="{{(!empty($editData['student']['image']))?url('public/upload/backend_imgs/' . $editData['student']['image']):url('public/upload/no-img.png')}}" alt="student_image" id="showImage" style="height: 120px;width:100px;border:1px solid #000">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">{{(@$editData)?'Promotion':'Submit'}}</button>
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
                    "name" : { required: true, },
                    "mobile" : { required: true, },
                    "fname" : { required: true, },
                    "mname" : { required: true, },
                    "address" : { required: true, },
                    "gender" : { required: true, },
                    "religion" : { required: true, },
                    "discount" : { required: true, },
                    "year_id" : { required: true, },
                    "class_id" : { required: true, },
                    "dob" : { required: true, },
                    "image" : { required: true, }
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
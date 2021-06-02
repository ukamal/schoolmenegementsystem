@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee Registration</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Registration Form</li>
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
                                    @if(isset($employees))
                                        Edit Employee
                                    @else 
                                        Add Employee
                                    @endif
                                    <a href="{{ route('employee-regi-view') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i> Employee List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ (@$employees)?route('employee-regi-update',$employees->id):route('employee-regi-store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{@$employees->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Employee Name <font style="color: red">*</font></label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="{{@$employees->name}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Mobile">Mobile No <font style="color: red">*</font></label>
                                            <input type="text" name="mobile" value="{{ @$employees->mobile }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="father's name">Father's Name <font style="color: red">*</font></label>
                                            <input type="text" name="fname" value="{{@$employees->fname}}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Mother's Name">Mother's Name <font style="color: red">*</font></label>
                                            <input type="text" name="mname" value="{{ @$employees->mname }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Address">Address <font style="color: red">*</font></label>
                                            <input type="text" name="address" value="{{ @$employees->address }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-4">
                                        <label for="Gender">Gender <font style="color: red">*</font></label>
                                        <select name="gender" id="gender" class="form-control form-control-sm">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{(@$employees->gender=='male')?'selected':''}}>Male</option>
                                            <option value="female" {{(@$employees->gender=='female')?'selected':''}}>Female</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="religion">Religion <font style="color: red">*</font></label>
                                            <select name="religion" id="religion" class="form-control form-control-sm">
                                                <option value="">Select Religion</option>
                                                <option value="Islam" {{(@$employees->religion=='Islam')?'selected':''}}>Islam</option>
                                                <option value="Hindu" {{(@$employees->religion=='Hindu')?'selected':''}}>Hindu</option>
                                                <option value="Krishtan" {{(@$employees->religion=='Krishtan')?'selected':''}}>Kristan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="designations">Designation <font style="color: red">*</font></label>
                                            <select name="designation_id" id="designation_id" class="form-control form-control-sm">
                                                <option value="">Select designations</option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if(!@$employees)
                                        <div class="form-group col-md-4">
                                            <label for="join_date">Join Date <font style="color: red">*</font></label>
                                            <input type="text" name="join_date" id="join_date" value="{{@$employees->join_date}}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="salary">Salary <font style="color: red">*</font> </label>
                                            <input type="text" name="salary" id="salary" value="{{@$employees->salary}}" class="form-control form-control-sm">
                                        </div>
                                        @endif
                                        <div class="form-group col-md-3">
                                            <label for="dob">Date of Birth <font style="color: red">*</font></label>
                                            <input type="text" name="dob" value="{{ @$employees->dob }}" class="form-control form-control-sm singledatepicker" autocomplete="off">
                                        </div>
                                        <div class="form-group-col-md-3">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" id="image" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group-col-md-3">
                                            <img src="{{(!empty($employees->image))?url('public/upload/employee_image/' . $employees->image):url('public/upload/no-img.png')}}" alt="student_image" id="showImage" style="height: 120px;width:100px;border:1px solid #000">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">{{(@$employees)?'Update':'Submit'}}</button>
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
                    "designation_id" : { required: true, },
                    "join_date" : { required: true, },
                    "salary" : { required: true, },
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
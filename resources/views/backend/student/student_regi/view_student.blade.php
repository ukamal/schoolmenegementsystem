@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
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
                                    Registered Student List
                                    <a href="{{ route('add-registration') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Student</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('student-year-calss-search')}}" method="GET" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group-col-md-4">
                                            <label>Year <font style="color: red">*</font></label>
                                            <select name="year_id" id="year" class="form-control form-control-sm">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{$year->id}}" {{(@$year_id==$year->id)?"selected":""}}>{{$year->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="class">Class <font style="color: red">*</font></label>
                                            <select name="class_id" id="class" class="form-control form-control-sm">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}" {{(@$class_id==$class->id)?"selected":""}}>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4" style="padding-top: 30px">
                                            <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          
                            <div class="card-body">
                                @if (!@$search)
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Roll</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Image</th>
                                            @if (Auth::user()->role=="admin")
                                                <th>Code</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value['student']['name']}}</td>
                                            <td>{{$value['student']['id_no']}}</td>
                                            <td>{{$value->roll}}</td>
                                            <td>{{$value['year']['name']}}</td>
                                            <td>{{$value['student_class']['name']}}</td>
                                            <td>
                                                <img src="{{(!empty($value['student']['image']))?url('public/upload/backend_imgs/' . $value['student']['image']):url('public/upload/no-img.png')}}" alt="" width="100px" height="120px">
                                            </td>
                                            @if (Auth::user()->role=="admin")
                                              <td>{{$value['student']['code']}}</td>
                                            @endif
                                            <td>
                                                <a title="Edit" href="{{ route('edit-registration',$value->student_id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Promotion" href="{{ route('student-regi-promotion',$value->student_id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a target="_blank" href="{{ route('student-regi-details',$value->student_id) }}" title="Details" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Roll</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Image</th>
                                            @if (Auth::user()->role=="admin")
                                                <th>Code</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value['student']['name']}}</td>
                                            <td>{{$value['student']['id_no']}}</td>
                                            <td>{{$value->roll}}</td>
                                            <td>{{$value['year']['name']}}</td>
                                            <td>{{$value['student_class']['name']}}</td>
                                            <td>
                                                <img src="{{(!empty($value['student']['image']))?url('public/upload/backend_imgs/' . $value['student']['image']):url('public/upload/no-img.png')}}" alt="" width="100px" height="120px">
                                            </td>
                                            @if (Auth::user()->role=="admin")
                                              <td>{{$value['student']['code']}}</td>
                                            @endif
                                            <td>
                                                <a title="Edit" href="{{ route('edit-registration',$value->student_id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Promotion" href="{{ route('student-regi-promotion',$value->student_id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a target="_blank" href="{{ route('student-regi-details',$value->student_id) }}" title="Details" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
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
                    "year" : { required: true, },
                    "class" : { required: true, }
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
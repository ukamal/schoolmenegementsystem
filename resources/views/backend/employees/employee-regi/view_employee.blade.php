@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee</li>
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
                                    Employee List
                                    
                                    <a href="{{ route('employee-regi-add') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Employee</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Join Date</th>
                                        <th>Salary</th>
                                        @if (Auth::user()->role=="admin")
                                            <th>Code</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->id_no}}</td>
                                            <td>{{$employee->mobile}}</td>
                                            <td>{{$employee->address}}</td>
                                            <td>{{$employee->gender}}</td>
                                            <td>{{date('d-m-Y',strtotime($employee->join_date))}}</td>
                                            <td>{{$employee->salary}}</td>
                                            @if (Auth::user()->role=="admin")
                                              <td>{{$employee->code}}</td>
                                            @endif
                                            <td>
                                                <a title="Edit" href="{{ route('employee-regi-edit',$employee->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a target="_blank" title="Details" href="{{route('employee-regi-details',$employee->id)}}" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
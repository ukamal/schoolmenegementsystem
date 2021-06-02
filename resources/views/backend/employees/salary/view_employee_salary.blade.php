@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee Salary</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Salary</li>
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
                                    Employee Salary List
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
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salaries as $key => $salary)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$salary->name}}</td>
                                            <td>{{$salary->id_no}}</td>
                                            <td>{{$salary->mobile}}</td>
                                            <td>{{$salary->address}}</td>
                                            <td>{{$salary->gender}}</td>
                                            <td>{{date('d-m-Y',strtotime($salary->join_date))}}</td>
                                            <td>{{$salary->salary}}</td>
                                            <td>
                                                <a title="Increment Salary" href="{{ route('employee-salary-increment',$salary->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <a title="Details" href="{{route('employee-salary-details',$salary->id)}}" class="btn btn-sm btn-success">
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
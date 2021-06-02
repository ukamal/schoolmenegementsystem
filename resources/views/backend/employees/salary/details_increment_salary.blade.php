@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Employee Increment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Increment</li>
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
                                        Increment Salary
                                    <a href="{{ route('employee-salary-view') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Employee Salary List</a>
                                </h3>
                            </div>
    <div class="card-body">
        <strong>Employee Name : </strong> {{$details->name}} , <strong>Employee Id No :</strong> {{$details->id_no}}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Previous Salary</th>
                    <th>Increment Salary</th>
                    <th>Present Salary</th>
                    <th>Effected Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salary_log as $key =>  $salary)
                <tr>
                    @if($key=='0')
                    <td class="text-center" colspan="5"> <strong>Joining Salary :</strong> {{$salary->previous_salary}}</td>
                    @else
                    <td>{{$key+1}}</td>
                    <td>{{$salary->previous_salary}}</td>
                    <td>{{$salary->present_salary}}</td>
                    <td>{{$salary->increment_salary}}</td>
                    <td>{{date('Y-m-d',strtotime($salary->effected_date))}}</td>
                    @endif
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
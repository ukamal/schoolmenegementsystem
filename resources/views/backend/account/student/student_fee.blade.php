@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Student Fee</li>
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
                                    Student Fee List
                                    
                                    <a href="{{ route('student-fee-add') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add / Edit Student Fee</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL:</th>
                                        <th>Id No</th>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $data)
                                        <tr class="{{$data->id}}">
                                            <td>{{$key+1}}</td>
                                            <td>{{$data['student']['id_no']}}</td>
                                            <td>{{$data['student']['name']}}</td>
                                            <td>{{$data['year']['name']}}</td>
                                            <td>{{$data['student_class']['name']}}</td>
                                            <td>{{$data['fee_category']['name']}}</td>
                                            <td>{{$data->amount}} TK</td>
                                            <td>{{date('M Y',strtotime($data->date))}}</td>
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


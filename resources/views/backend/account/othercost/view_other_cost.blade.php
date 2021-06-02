@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Other's Cost</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Other's Cost</li>
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
                                    Other's Cost List
                                    
                                    <a href="{{ route('others-cost-add') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add / Edit Other's Cost</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No:</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $data)
                                        <tr class="{{$data->id}}">
                                            <td>{{$key+1}}</td>
                                            <td>{{date('M Y',strtotime($data->date))}}</td>
                                            <td>{{$data->amount}} TK</td>
                                            <td>{{$data->description}}</td>
                                            <td>
                                                <img src="{{(!empty($data->image))?url('public/upload/cost_image/'.$data->image):url('public/upload/no-img.png')}}" alt="img" height="60px" width="90px;">
                                            </td>
                                            <td>
                                                <a title="Edit" href="{{route('others-cost-edit',$data->id)}}" class="btn btn-info btn-sm">
                                                <i class="fa fa-edit"></i>
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


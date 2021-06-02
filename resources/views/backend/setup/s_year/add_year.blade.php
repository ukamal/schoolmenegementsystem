@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student Year</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Year</li>
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
                                    @if(isset($years))
                                        Edit Student Year
                                    @else 
                                        Add Student Year
                                    @endif
                                    <a href="{{ route('student-year-view') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Student Year List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ (@$years)?route('student-year-update',$years->id):route('student-year-store') }}" method="post" id="myForm" enctype="multipart/form-years">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Student Year</label>
                                            <input type="text" name="name" class="form-control" value="{{@$years->name}}">
                                            <font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">{{(@$years)?'Update':'Submit'}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  

@endsection
@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Designation</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Designation</li>
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
                                    @if(isset($designations))
                                        Edit Designation
                                    @else 
                                        Add Designation
                                    @endif
                                    <a href="{{ route('view-designation') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Designation List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ (@$designations)?route('update-designation',$designations->id):route('store-designation') }}" method="post" id="myForm" enctype="multipart/form-years">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Designation</label>
                                            <input type="text" name="name" class="form-control" value="{{@$designations->name}}">
                                            <font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">{{(@$designations)?'Update':'Submit'}}</button>
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
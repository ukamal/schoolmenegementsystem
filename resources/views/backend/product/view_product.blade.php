@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                Product List
                <a href="{{ route('add-product') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Product</a>
              </h3>
              </div>
              <div class="card-body">
                 <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Product Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$product->title}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->price}}</td>
                      <td>
                        <img src="{{(!empty($product->image))?url('public/upload/backend_imgs/'.$product->image):url('public/upload/no-img.png')}}" height="150px" width="200px" alt="product">
                      </td>
                      <td>
                        <a title="Edit" href="{{ route('edit-product',$product->id) }}" class="btn btn-sm btn-primary">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a title="Delete" id="delete" href="{{ route('delete-product',$product->id)}}" class="btn btn-sm btn-danger">
                          <i class="fa fa-trash"></i>
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
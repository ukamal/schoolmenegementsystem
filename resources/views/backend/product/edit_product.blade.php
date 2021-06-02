@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                Edit Product
                <a href="{{ route('view-product') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i>Product List</a>
              </h3>
              </div>
              <div class="card-body">
                <form action="{{route('update-product',$editData->id)}}" method="post" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" value="{{$editData->title}}">
                      <!-- {{($errors->has('title'))?($errors->first('title')):''}} -->
                    </div>
                    <div class="form-group col-md-4">
                      <label for="description">Description</label>
                      <input type="text" name="description" class="form-control" value="{{$editData->description}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="price">Price</label>
                      <input type="text" name="price" id="price" class="form-control" value="{{$editData->price}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="image">Image</label>
                      <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <img id="showImage" src="{{(!empty($editData->image))?url('public/upload/backend_imgs/'.$editData->image):url('public/upload/no-img.png')}}" style="height: 160px;width: 150px;border: 1px solid #000" alt="img">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                  </div>
                </form>
              </div>
          </div>  
          <script>
                  $(function () {
                      $('#myForm').validate({
                          rules: {
                              title: {
                                  required: true,
                              },
                              description: {
                                  required: true,
                              },
                              price: {
                                  required: true,
                              },
                          },
                          messages: {
                              title: {
                                  required: "Please enter a title",
                              },
                              description: {
                                  required: "Please enter some comment",
                              },
                              price: {
                                  required: "Please enter some value",
                              },
                              terms: "Please accept our terms"
                          },
                          errorElement: 'span',
                          errorPlacement: function (error, element) {
                              error.addClass('invalid-feedback');
                              element.closest('.form-group').append(error);
                          },
                          highlight: function (element, errorClass, validClass) {
                              $(element).addClass('is-invalid');
                          },
                          unhighlight: function (element, errorClass, validClass) {
                              $(element).removeClass('is-invalid');
                          }
                      });
                  });
              </script>
          </div>
        </div>
      </div>
    </section>
  </div>



 @endsection
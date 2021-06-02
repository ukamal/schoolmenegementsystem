@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Other Cost</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Other Cost</li>
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
                                   @if(isset($allData))
                                   Edit Cost 
                                   @else 
                                   Add Cost 
                                   @endif
                                    <a href="{{ route('others-cost-view') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Other's Cost List</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                              <form action="{{(@$allData)?route('others-cost-update',$allData->id):route('others-cost-store')}}" id="myForm" method="post" enctype="multipart/form-data">
                                    @csrf 
                                   <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="text" name="date" value="{{date('d-m-Y',strtotime(@$allData->date))}}" class="form-control form-control-sm singledatepicker" placeholder="Date" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" value="{{(@$allData->amount)}}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="img">Image</label>
                                        <input type="file" name="image" id="image" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <img id="showImage" src="{{(!empty(@$allData->image))?url('public/upload/cost_image/'.@$allData->image):url('public/upload/no-img.png')}}" alt="img" width="300px;" height="150px" style="border:1px solid #000">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label> <br>
                                       <textarea name="description" id="description" cols="60" rows="4">{{(@$allData->description)}}</textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary">{{(@$allData)?"Update":"Submit"}}</button>
                                    </div>
                                   </div>
                                </form>
                            </div>
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
                    "date" : {required : true},
                    "amount" : {required : true},
                    "image" : {required : true},
                    "description" : {required : true}
                },
                message: {},
                errorElement: 'span',
                errorPlacement: function(error, element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight:function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element,errorClass,validClass){
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

@endsection
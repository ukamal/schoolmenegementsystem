@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Fee Amount Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Details Fee Amount</li>
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
                                    <a href="{{ route('fee-cat-amount-view') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Fee Amount List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <h4><strong>Fee Type : </strong>{{$amounts['0']['fee_category']['name']}}</h4>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Class.</th>
                                            <th>Amount.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($amounts as $key => $value)
                                            <tr class="">
                                                <td>{{$key+1}}</td>
                                                <td>{{$value['student_class']['name']}}</td>
                                                <td>{{$value->amount}}</td>
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

    <script type="text/javascript">
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules:{
                "fee_category_id" : { required: true, },
                "class_id[]" : { required: true, },
                "amount[]" : { required: true, }
            },
            message: {},
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>
  

@endsection
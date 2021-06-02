@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Employee Salary</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Salary added</li>
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
                                   Add / Edit Employee Salary
                                    <a href="{{ route('employee-salary-view') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Employee Salary List</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                               <div class="form-row" id="myForm">
                                   <div class="form-group col-md-4">
                                       <label for="date" class="control-label">Date</label>
                                       <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="Date" readonly>
                                   </div>
                                   <div class="form-group col-md-2">
                                       <a class="btn btn-sm btn-success" id="search" style="margin-top: 33px;color:#fff">Search</a>
                                   </div>
                               </div>
                            </div>
                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <form action="{{route('employee-salary-store')}}" method="post">
                                        @csrf 
                                        <table class="table-sm table-bordered table-striped" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    @{{{thsource}}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @{{#each this}}
                                                <tr>
                                                    @{{{tdsource}}}
                                                </tr>
                                                @{{/each}}
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px">Submit</button>
                                    </form>
                                </script>
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
                    "date" : {required : true}
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

    <script>
        $(document).on('click','#search',function(){
            var date = $('#date').val();
            $('.notifyjs-corner').html('');
            if(date == ''){
                $.notify("Date required", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            $.ajax({
                url: "{{route('employee-salary-get')}}",
                type: "get",
                data: {'date':date},
                beforeSend: function(){
                },
                success: function(data){
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>

@endsection
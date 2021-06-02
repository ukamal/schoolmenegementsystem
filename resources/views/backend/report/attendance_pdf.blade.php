<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Employee Attendance Report </title>
    <style>
       table{
          border-collapse: collapse;
      }
      h2 h3{
          margin: 0;
          padding: 0;
      }
      table{
          width: 100%;
          margin-bottom: 1rem;
          background-color: transparent;
      }
     
      table thead th{
          vertical-align: bottom;
          border-bottom: 2px solid #dee2e6;
      }
      table tbody + tbody{
          background-color: #ffffff;
      }
      table-bordered{
          border: 1px solid #dee2e6;
      }
      table-bordered th,
      table-bordered td{
          border: 1px solid #dee2e6;
      }
      table-bordered thead th,
      table-bordered thead td{
          border-bottom-width: 2px;
      }
      .text-center{
          text-align: center;
      }
      .text-right{
          text-align: right;
      }
      .table-bordered thead th, .table-bordered td, .table-bordered th{
          border: 1px solid #000!important;
      }
      .table-bordered thead th{
          background-color: #cacaca;
      } 

      /* .col-md-12.wrapper tr td {
            border: 1px solid #000;
        } */
    </style>
  </head>
  <body>
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{url('public/upload/slogo.png')}}" alt="logo" width="100px" height="80px">
                        </td>
                        <td class="text-center" width="63%">
                           <h4> <strong>Primary School</strong></h4>
                           <h4> <strong>Dhaka, Bangladesh</strong></h4>
                           <h4> <strong>www.kamalhossen.com</strong></h4>
                        </td>
                        <td class="text-center">
                            <img src="{{(!empty($allData['0']['employee']['image']))?url('public/upload/employee_image/'
                            .$allData['0']['employee']['image']):url('public/upload/no-img.png')}}" 
                            alt="employee-image" width="80px" height="100px">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold">Employee Attendance Report</h5>
            </div>
            <div class="col-md-12 wrapper">
                <strong>Employee Name: {{$allData['0']['employee']['name']}},</strong>
                <strong>Id No: {{$allData['0']['employee']['id_no']}},</strong>
                <strong>Month: {{$month}}</strong>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Attend Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $data)
                            <tr>
                                <td style="width: 50%;">{{date('d-m-Y',strtotime($data->date))}}</td>
                                <td width="50%">{{$data->attend_status}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <strong>Total Absent:</strong> {{$absents}},
                                <strong>Total Leave:</strong> {{$leaves}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px;float-right">
                Print Date: {{date("d M Y")}}</i>
            </div>
            <br>
            <div class="col-md-12">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td width="30%"></td>
                            <td width="30%"></td>
                            <td style="width:40%;text-align:center">
                                <hr style="border:solid 1px;width:60%;color:#000;margin-bottom:0;">
                                <p style="text-align:center">Principal/Head Master</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr style="border: dashed 1px;width:100%;color:#ddd">
       
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>
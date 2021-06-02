<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monthly/Yearly Profit</title>
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
      table th,
      table td{
          margin: 0.75rem;
          vertical-align: top;
          border-top: 1px solid #dee2e6;
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

      .col-md-12.wrapper tr td {
            border: 1px solid #000;
        }
    </style>
  </head>
  <body>
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{url('public/upload/slogo.png')}}" alt="logo" width="120px" height="100px">
                        </td>
                        <td class="text-center" width="63%">
                           <h4> <strong>Primary School</strong></h4>
                           <h4> <strong>Dhaka, Bangladesh</strong></h4>
                           <h4> <strong>www.kamalhossen.com</strong></h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold">Monthly/Yearly Profit</h5>
            </div>
            <div class="col-md-12 wrapper">
              @php
                   $student_fee = App\Models\Account\StudentFee::whereBetween('date',[$sdate, $edate])->where('fee_category_id','1')->sum('amount');
                   $other_cost = App\Models\Account\OtherCost::whereBetween('date',[$start_date, $end_date])->sum('amount');
                   $employee_salary = App\Models\Account\EmployeeSalary::whereBetween('date',[$sdate, $edate])->sum('amount');

                   $total_cost = $other_cost+$employee_salary;
                   $profit = $student_fee-$total_cost;
              @endphp
              <table border="1" width="100%">
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <h4>
                                Reporting Date: {{date('d M Y',strtotime($start_date))}} - {{date('d M Y',strtotime($end_date))}}
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">Purpose</td>
                        <td style="width:50%">Amount</td>
                    </tr>
                    <tr>
                        <td>Student Fees</td>
                        <td>{{$student_fee}} TK</td>
                    </tr>
                    <tr>
                        <td>Employeer Salary</td>
                        <td>{{$employee_salary}} TK</td>
                    </tr>
                    <tr>
                        <td>Others Cost</td>
                        <td>{{$other_cost}} TK</td>
                    </tr>
                    <tr>
                        <td>Total Cost</td>
                        <td>{{$total_cost}} TK</td>
                    </tr>
                    <tr>
                        <td>Profit</td>
                        <td>{{$profit}} TK</td>
                    </tr>
                </tbody>
              </table>
              <i style="font-size: 10px;float:right">Print Date: {{date("d m Y")}}</i>
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
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>
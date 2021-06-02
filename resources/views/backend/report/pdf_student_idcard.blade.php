<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Student ID Card Generate </title>
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

        #cornerDesign{
            background: rgb(73, 39, 39);height:50px;width:50px;float:left;margin-bottom:0px;  border-top-right-radius:100%;
        }
        
    </style>
  </head>
  <body>
   
    <div class="container">
        <div class="container" style="margin:0 auto;width:70%">
            @foreach ($allData as $data)
                <div class="row">
                <div id="borderRadius" class="col-md-3" style="border:5px solid #000; margin-bottom:20px;border-radius:10px;">
                   
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="5">
                                <img src="{{url('public/upload/slogo.png')}}" alt="logo" width="100px" height="80px">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="5">
                               <h4> <strong>Primary School</strong></h4>
                               <h4> <strong>Dhaka, Bangladesh</strong></h4>
                               <h4> <strong>www.kamalhossen.com</strong></h4>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td class="text-center" colspan="5">
                                <img src="{{(!empty($allData['0']['student']['image']))?url('public/upload/backend_imgs/'
                                .$allData['0']['student']['image']):url('public/upload/no-img.png')}}" 
                                alt="student-image" width="80px" height="100px">
                            </td>
                        </tr>
                        <br>
                        <tr>
                           <td></td>
                            <td style="padding-top:10px;font-size:16px;" colspan="2"><strong>Name: </strong>{{$data['student']['name']}}</td>
                            <td style="padding-top:10px;font-size:16px;" colspan="2"><strong>Id No: </strong>{{$data['student']['id_no']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding:10px 3px;font-size:16px" colspan="2"><strong>Session: </strong>{{$data['year']['name']}}</td>
                            <td style="padding:10px 3px;font-size:16px" colspan="2"><strong>Class: </strong>{{$data['student_class']['name']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding:10px 3px;font-size:16px" colspan="2"><strong>Roll: </strong>{{$data->roll}}</td>
                            <td style="padding:10px 3px;font-size:16px" colspan="2"><strong>Mobile No: </strong>{{$data['student']['mobile']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center" colspan="6">
                                <hr style="border: solid 1px; width:50%;color:#000;margin-bottom:0px;">
                                Headmaster
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="cornerDesign"></div>
                </div>
                </div>
            @endforeach
        </div>
          
        
        <hr style="border: dashed 1px;width:100%;color:#ddd">
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>
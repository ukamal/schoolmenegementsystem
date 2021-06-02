<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Student Result </title>
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
                           
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold">Student Result of {{@$allData[0]['exam_type']['name']}}</h5>
                <hr>
            </div>
           
            <div class="col-md-12 wrapper">
                <table border="1" width="100%" cellpadding="1" cellspacing="2" class="text-center">
                   <tbody>
                       <tr>
                           <td><strong>Session:</strong>{{@$allData[0]['year']['name']}}</td>
                           <td></td>
                           <td></td>
                           <td><strong>Class:</strong>{{@$allData[0]['student_class']['name']}}</td>
                       </tr>
                   </tbody>
                </table>
                <br>
                <table border="1" width="100%" cellpadding="1" cellspacing="2" class="text-center">
                    <thead>
                        <tr>
                        <th>S/L</th>
                        <th>Student Name:</th>
                        <th>ID No:</th>
                        <th>Letter Grade</th>
                        <th>Grade Point</th>
                        <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $data)
                        @php
                            $allMarks = App\Models\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)
                            ->where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get();
                            $total_marks = 0;
                            $total_point = 0;
                            foreach ($allMarks as $value) {
                                $count_fail = App\Models\StudentMarks::where('year_id',$value->year_id)->where('class_id',$value->class_id)
                                ->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->where('marks','<','33')->get()->count();
                                $get_mark = $value->marks;
                                $grade_marks = App\Models\MarksGrade::where([['start_marks','<=',(int)$get_mark],['end_marks','>=',(int)$get_mark]])->first();
                                $grade_name = $grade_marks->grade_name;
                                $grade_point = number_format((float)$grade_marks->grade_point,2);
                                $total_point = (float)$total_point+(float)$grade_point;
                            }
                        @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$data['student']['name']}}</td>
                                <td>{{$data['student']['id_no']}}</td>
                                @php
                                    $total_subject = App\Models\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)
                                    ->where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get()->count();
                                    $total_grade = 0;
                                    $point_for_letter_grade = (float)$total_point/(float)$total_subject;
                                    $total_grade = App\Models\MarksGrade::where([['start_point','<=',$point_for_letter_grade],['end_point','>=',$point_for_letter_grade]])->first();
                                    $grade_point_avg = (float)$total_point/(float)$total_subject;
                                @endphp
                                <td>
                                    @if ($count_fail > 0)
                                        F 
                                        @else 
                                        {{$total_grade->grade_name}}
                                    @endif
                                </td>
                                <td>
                                    @if ($count_fail > 0)
                                        0.00
                                        @else 
                                        {{number_format((float)$grade_point_avg,2)}}
                                    @endif
                                </td>
                                <td>
                                    @if ($count_fail > 0)
                                        Fail 
                                        @else 
                                        {{$total_grade->remakrs}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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
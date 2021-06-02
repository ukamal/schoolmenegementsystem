@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Marksheet Generate</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Marksheet</li>
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
                                   Marksheet Generate
                                </h3>
                            </div>
                            <div class="card-body">
                              <div style="border: 2px solid #000; padding:7px">
                                <div class="row">
                                    <div style="float: right" class="col-md-2 text-center">
                                        <img src="{{url('public/upload/slogo.png')}}" alt="logo" width="120px" height="120px;float-left">
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4 text-center" style="float: left">
                                    <h4><strong>Primary School</strong></h4>
                                    <h6><strong>Primary School</strong></h6>
                                    <h5><strong><u><i>Academy Trasncript</i></u></strong></h5>
                                    <h6><strong>{{$allMarks['0']['exam_type']['name']}}</strong></h6>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <hr style="border: 1px solid #ddd;margin-bottom:0px">
                                        <p>Print Date: {{date('m-d-Y')}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                            @php
                                                $assign_subject = App\Models\AssignStudent::where('year_id',$allMarks['0']->year_id)->where('class_id',$allMarks['0']->class_id)->first();
                                            @endphp
                                            <tr>
                                                <td width="50%">Student Id</td>
                                                <td width="50%">{{$allMarks['0']['id_no']}}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Roll No</td>
                                                <td width="50%">{{$assign_subject->roll}}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Name</td>
                                                <td width="50%">{{$allMarks['0']['student']['name']}}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Class</td>
                                                <td width="50%">{{$allMarks['0']['student_class']['name']}}</td>
                                            </tr>
                                            <tr>
                                                <td width="50%">Session</td>
                                                <td width="50%">{{$allMarks['0']['year']['name']}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                           <thead>
                                                <tr>
                                                    <th>Letter Grade</th>
                                                    <th>Marks Interval</th>
                                                    <th>Grade Point</th>
                                                </tr>
                                           </thead>
                                           <tbody>
                                               @foreach ($allGrades as $Grade)
                                                   <tr>
                                                       <td>{{$Grade->grade_name}}</td>
                                                       <td>{{$Grade->start_marks}} - {{$Grade->end_marks}}</td>
                                                       <td>{{ number_format((float)$Grade->grade_point,2) }}
                                                        - {{ ($Grade->grade_point == 5)? (number_format((float)$Grade->grade_point,2)) : (number_format((float)$Grade->grade_point+1,2) - (float)0.01) }}
                                                        </td>
                                                   </tr>
                                               @endforeach
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
<br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">SL</th>
                                                    <th class="text-center">Subject</th>
                                                    <th class="text-center">Full Marks</th>
                                                    <th class="text-center">Get Marks</th>
                                                    <th class="text-center">Letter Grade</th>
                                                    <th class="text-center">Grade Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_marks = 0;
                                                    $total_point = 0;
                                                @endphp
                                                @foreach ($allMarks as $key => $mark)
                                                    @php
                                                        $get_mark = $mark->marks;
                                                        $total_marks = (float)$total_marks+(float)$get_mark;
                                                        $total_subject = App\Models\StudentMarks::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)
                                                        ->where('exam_type_id',$mark->exam_type_id)->where('student_id',$mark->student_id)->get()->count();
                                                    @endphp
                                                    <tr>
                                                        <th class="text-center">{{$key+1}}</th>
                                                        <th class="text-center">{{$mark['assign_subject']['subject']['name']}}</th>
                                                        <th class="text-center">{{$mark['assign_subject']['full_mark']}}</th>
                                                        <th class="text-center">{{$get_mark}}</th>
                                                        @php
                                                            $grade_marks = App\Models\MarksGrade::where([['start_marks','<=',(int) $get_mark], ['end_marks','>=',(int)
                                                            $get_mark]])->first();
                                                            $grade_name = $grade_marks->grade_name;
                                                            $grade_point = number_format((float)$grade_marks->grade_point,2);
                                                            $total_point = (float)$total_point+(float)$grade_point;
                                                        @endphp
                                                        <td class="text-center">{{$grade_name}}</td>
                                                        <td class="text-center">{{$grade_point}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" style="padding-left: 30px"><strong>Total Marks</strong></td>
                                                    <td colspan="3" style="padding-left: 30px"><strong>{{$total_marks}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                            
                                            <tbody>
                                                @php
                                                    $total_grade = 0;
                                                    $print_for_letter_grade = (float)$total_point/(float)$total_subject;
                                                    $total_grade = App\Models\MarksGrade::where([['start_point','<=',$print_for_letter_grade],
                                                    ['end_point','>=',$print_for_letter_grade]])->first();

                                                    $grade_point_avg = (float)$total_point/(float)$total_subject;
                                                @endphp
                                                <tr>
                                                    <td colspan="3" style="padding-left: 30px"><strong>Grade Point Average</strong></td>
                                                    <td colspan="3" style="padding-left: 30px">
                                                       @if ($count_fail > 0)
                                                        0.00
                                                       @else 
                                                           {{number_format((float)$grade_point_avg,2)}}
                                                       @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%">Letter Grade</td>
                                                    <td colspan="3" style="padding-left: 30px">
                                                        @if ($count_fail > 0)
                                                         F
                                                        @else 
                                                            {{$total_grade->grade_name}}
                                                        @endif
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%">Total Marks with Fraction</td>
                                                    <td width="50%">{{$total_marks}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1" width="100%" cellpadding="9" cellspacing="2">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" style="padding-left: 30px"><strong>Remarks</strong></td>
                                                    <td colspan="3" style="padding-left: 30px">
                                                       @if ($count_fail > 0)
                                                        Fail
                                                       @else 
                                                           {{$total_grade->remakrs}}
                                                       @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <hr style="border: solid 1px;width:60%;color:#000;margin-bottom:-3px">
                                        <div class="text-center">Teacher</div>
                                    </div>
                                    <div class="col-md-4">
                                        <hr style="border: solid 1px;width:60%;color:#000;margin-bottom:-3px">
                                        <div class="text-center">Parents/Guardiance</div>
                                    </div>
                                    <div class="col-md-4">
                                        <hr style="border: solid 1px;width:60%;color:#000;margin-bottom:-3px">
                                        <div class="text-center">Principal/Headmaster</div>
                                    </div>
                                </div>

                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection


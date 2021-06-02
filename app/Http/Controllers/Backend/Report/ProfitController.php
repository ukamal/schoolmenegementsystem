<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\EmployeeSalary;
use App\Models\Account\OtherCost;
use App\Models\Account\StudentFee;
use App\Models\StudentMarks;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\MarksGrade;
use App\Models\AmployeeAttendance;
use App\Models\User;
use App\Models\AssignStudent;
use PDF;

class ProfitController extends Controller
{
    public function view(){
        return view('backend.report.view_report');
    }

    public function profit(Request $request){
        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));

        $student_fee = StudentFee::whereBetween('date',[$start_date, $end_date])->sum('amount');
        $other_cost = OtherCost::whereBetween('date',[$sdate, $edate])->sum('amount');
        $employee_salary = EmployeeSalary::whereBetween('date',[$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost+$employee_salary;
        $profit = $student_fee-$total_cost;

        $html['thsource'] = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Others Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource'] = '<td>'.$student_fee.'</td>';
        $html['tdsource'] .= '<td>'.$other_cost.'</td>';
        $html['tdsource'] .= '<td>'.$employee_salary.'</td>';
        $html['tdsource'] .= '<td>'.$total_cost.'</td>';
        $html['tdsource'] .= '<td>'.$profit.'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blank" href="'.route("report-profit-pdf").'?start_date='.$sdate.'&end_date='.$edate.' "><i class="fa fa-file"></i></a>';
        $html['tdsource'] .='</td>';

        return response()->json(@$html);
    }

    public function pdf(Request $request){
        $data['sdate'] = date('Y-m',strtotime($request->start_date));
        $data['edate'] = date('Y-m',strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.report.pdf_report',$data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //Marksheet Ganarator

    public function studentMarkSheetView(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.marksheet_view',$data);
    }

    public function marksheetGet(Request $request){
        $year_id  = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no   = $request->id_no;
        
        $count_fail = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)
        ->where('id_no',$id_no)->where('marks','<','33')->get()->count();

        $singleStudent = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)
        ->where('id_no',$id_no)->first();

        if($singleStudent == true){
            $allMarks = StudentMarks::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)
            ->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
            $allGrades = MarksGrade::all();
            // dd($allMarks->toArray());
            return view('backend.report.marksheet_print',compact('allMarks','allGrades','count_fail'));
        }else{
            return redirect()->back()->with('error','Sorry! These criteria does not match.');
        }
       
    }

    public function attendanceReport(){
       $data['employees'] = User::where('user_type','employee')->get();
       return view('backend.report.attendace_view',$data);
    }

    public function attendanceGet(Request $request){
      $employee_id = $request->employee_id;
      if($employee_id !=''){
          $where[] = ['employee_id',$employee_id];
      }
      $date = date('Y-m',strtotime($request->date));
      if($date !=''){
          $where[] = ['date','like',$date. '%'];
      }
      $singleAttenadance = AmployeeAttendance::with(['employee'])->where($where)->first();
      if($singleAttenadance == true){
          $data['allData'] = AmployeeAttendance::with(['employee'])->where($where)->get();
        //   dd($data['allData']->toArray());
          $data['absents'] = AmployeeAttendance::with(['employee'])->where($where)->where('attend_status','Absent')->get()->count();
          $data['leaves'] = AmployeeAttendance::with(['employee'])->where($where)->where('attend_status','Leave')->get()->count();
          $data['month'] = date('M Y',strtotime($request->date));
          $pdf = PDF::loadView('backend.report.attendance_pdf',$data);
          $pdf->SetProtection(['copy','print'],'','pass');
          return $pdf->stream('document.pdf');
      }else{
          return redirect()->back()->with('error','Sorry These criteria does not match');
      }

    }

    //Student Result View
    public function resultView(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.student_sesult_view',$data);
    }

    public function resultGet(Request $request){
        $year_id    = $request->year_id;
        $class_id   = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $singleResult = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)
        ->where('exam_type_id',$exam_type_id)->first();
        if($singleResult == true){
            $data['allData'] = StudentMarks::select('year_id','class_id','exam_type_id','student_id')
            ->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)
            ->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            $pdf = PDF::loadView('backend.report.pdf_result',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');
        }else{
            return redirect()->back()->with('success','error','Sorry These criteria does not match');
        }
    }

    public function idcardView(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.report.student_idcard_view',$data);
    }

    public function idcardGet(Request $request){
        $year_id    = $request->year_id;
        $class_id   = $request->class_id;
        $check_data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();
        if($check_data == true){
            $data['allData'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
            // dd($data['allData']->toArray());
            $pdf = PDF::loadView('backend.report.pdf_student_idcard',$data);
            $pdf->SetProtection(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');
        }else{
            return redirect()->back()->with('success','error','Sorry These criteria does not match');
        }
    }


}

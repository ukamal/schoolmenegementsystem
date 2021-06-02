<?php

namespace App\Http\Controllers\Backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Models\AmployeeAttendance;
use App\Models\User;
use PDF;

class MonthlySalaryConroller extends Controller
{
    public function view(){
        return view('backend.employees.monthly-salary.view_monthly_salary');
    }

    public function getSalary(Request $request){
        $date = date('Y-m',strtotime($request->date));
        if($date != ''){
            $where[] = ['date','like',$date . '%'];
        }
        $data = AmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        //dd($data);
        $html['thsource'] = '<th>Sl.</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($data as $key => $attend){
            $totalattend = AmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status','Absent'));
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['employee']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['employee']['salary'].'</td>';
            $salary = (float)$attend['employee']['salary'];
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday;
            $totalsalary = (float)$salary-(float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>'.$totalsalary.'Tk'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" 
            href="'.route("monthly-salary-payslip",$attend->employee_id).'">Pay Slip</a>';
            $html[$key]['tdsource'] .='</td>';
        }
        return response()->json(@$html);
    }

    public function payslip(Request $request, $employee_id){
       $id = AmployeeAttendance::where('employee_id',$employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if($date != ''){
            $where[] = ['date','like',$date.'%'];
        }
        $data['totalattendgroupbyid'] = AmployeeAttendance::with(['employee'])->where($where)
        ->where('employee_id',$id->employee_id)->get();
        $pdf = PDF::loadview('backend.employees.monthly-salary.monthly_salary_pdf',$data);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
    }
}

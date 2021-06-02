<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\StudentFee;
use App\Models\StudentYear;
use App\Models\FeeCat;
use App\Models\StudentClass;
use App\Models\AssignStudent;
use App\Models\FeeCatAmount;
use App\Models\User;
use App\Models\AmployeeAttendance;
use App\Models\Account\EmployeeSalary;

class EmploSalaryController extends Controller
{
    public function view(){
        $data['allData'] = EmployeeSalary::all();
        return view('backend.account.employee.view_emplo_salary',$data);
    }

    public function add(){
        return view('backend.account.employee.add_emplo_salary');
    }
    
    public function getEmployee(Request $request){
        $date = date('Y-m',strtotime($request->date));
        if($date !=''){
            $where[] = ['date','like',$date.'%'];
        }
        $data = AmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        $html['thsource'] = '<th>SL No</th>';
        $html['thsource'] .= '<th>Id No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Month)</th>';
        $html['thsource'] .= '<th>Select</th>';
        foreach($data as $key => $attend){
            $account_salary = EmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();
            if($account_salary !=null){
                $checked = 'checked';
            }else{
                $checked='';
            }
            $totalattend = AmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status','Absent'));
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['employee']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['employee']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['employee']['salary'].'</td>';
            $salary = (float)$attend['employee']['salary'];
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday;
            $totalsalary = (float)$salary*(float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>'.$totalsalary.'<input type="hidden" name="amount[]" value="'.$totalsalary.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'
            .'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform: scale(1.s);margin-left:10px;">'.'</td>';
        }
        return response()->json(@$html);
    }

    public function store(Request $request){
        $date = date('Y-m',strtotime($request->date));
        EmployeeSalary::where('date',$date)->delete();
        $checkdata = $request->checkmanage;
        if($checkdata !=null){
            for($i=0; $i <count($checkdata); $i++){
                $data = new EmployeeSalary();
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        if(!empty(@$data) || empty($checkdata)){
            return redirect()->route('employee-salary-view')->with('success','Well done! Successfully Updated');
        }else{
            return redirect()->back()->with('error','Sorry! Data not saved');
        }
    }
}

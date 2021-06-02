<?php

namespace App\Http\Controllers\Backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeSalaryLog;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function view(){
        $data['salaries'] = User::where('user_type','employee')->get();
        return view('backend.employees.salary.view_employee_salary',$data);
    }

    public function increment($id){
        $data['increments'] = User::find($id);
        return view('backend.employees.salary.add_increment_salary',$data);
    }

    public function store(Request $request, $id){
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();
        $salaryData = new EmployeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
        $salaryData->save();
        return redirect()->route('employee-salary-view')->with('success','Salary Increment Successfully!');
    }

    public function details($id){
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeSalaryLog::where('employee_id',$data['details']->id)->get();
        //dd($data['salary_log']->toArray());
        return view('backend.employees.salary.details_increment_salary',$data);
    }


}

<?php

namespace App\Http\Controllers\Backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeLeavePurpose;
use App\Models\EmployeeLeave;
use App\Models\User;

class EmployeeLeaveController extends Controller
{
    public function view(){
        $data['editData'] = EmployeeLeave::orderBy('id','desc')->get();
        return view('backend.employees.employee-leave.view_employee_leave',$data);
    }

    public function add(){
        $data['employees'] = User::where('user_type','employee')->get();
        $data['leave_purpose'] = EmployeeLeavePurpose::all();
        return view('backend.employees.employee-leave.add_employee_leave',$data);
    }

    public function store(Request $request){
        if($request->leave_purpose_id == '0'){
            $leavepurpose = new EmployeeLeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employeeleave = new EmployeeLeave();
        $employeeleave->emloyee_id = $request->emloyee_id;
        $employeeleave->start_date = date('Y-m-d',strtotime($request->start_date));
        $employeeleave->end_date = date('Y-m-d',strtotime($request->end_date));
        $employeeleave->leave_purpose_id = $leave_purpose_id;
        $employeeleave->save();
        return redirect()->route('employee-leave-view')->with('success','Data inserted successfully!');
    }

    public function edit($id){
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('user_type','employee')->get();
        $data['leave_purpose'] = EmployeeLeavePurpose::all();
        return view('backend.employees.employee-leave.add_employee_leave',$data);
    }

    public function update(Request $request, $id){
        if($request->leave_purpose_id == '0'){
            $leavepurpose = new EmployeeLeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employeeleave = EmployeeLeave::find($id);
        $employeeleave->emloyee_id = $request->emloyee_id;
        $employeeleave->start_date = date('Y-m-d',strtotime($request->start_date));
        $employeeleave->end_date = date('Y-m-d',strtotime($request->end_date));
        $employeeleave->leave_purpose_id = $leave_purpose_id;
        $employeeleave->save();
        return redirect()->route('employee-leave-view')->with('success','Data updated successfully!');
    }
}

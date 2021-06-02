<?php

namespace App\Http\Controllers\Backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmployeeAttendance;
use App\Models\EmployeeLeavePurpose;
use App\Models\User;

class EmployeeAttendanceController extends Controller
{
    public function view(){
        $data['allData'] = AmployeeAttendance::orderBy('id','desc')->get();
        return view('backend.employees.employee-attend.view_employee_attend',$data);
    }

    public function add(){
        $data['employees'] = User::where('user_type','employee')->get();
        return view('backend.employees.employee-attend.add_employee_attend',$data);
    }

    public function store(Request $request){
        $countemployee = count($request->employee_id);
        for($i=0; $i <$countemployee ; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new AmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->route('employee-attend-view')->with('success','Data Inserted successfully!');
    }

    public function edit(){
        dd('ok');
    }
}

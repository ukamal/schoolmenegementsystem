<?php

namespace App\Http\Controllers\Backend\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeSalaryLog;
use App\Models\User;
use App\Models\Designation;
use DB;
use PDF;

class EmployeeRegiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['employees'] = User::where('user_type','employee')->get();
        return view('backend.employees.employee-regi.view_employee',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['designations'] = Designation::all();
        return view('backend.employees.employee-regi.add_employee',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use ($request){
            $checkEmployee = date('Ym',strtotime($request->join_date));
            //dd($checkEmployee);
            $employee = User::where('user_type','employee')->orderBy('id','DESC')->first();
            if($employee == NULL){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId < 10){
                    $id_no = '000' .$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00' .$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0' .$employeeId;
                }
            }else{
                $employee = User::where('user_type','employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee + 1;
                if($employeeId < 10){
                    $id_no = '100' .$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '10' .$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0' .$employeeId;
                }
            }

            $final_id_no = $checkEmployee.$id_no;
            $employee = new User();
            $code = rand(0000,9999);
            $employee->id_no    = $final_id_no;
            $employee->password = bcrypt($code);
            $employee->user_type = 'employee';
            $employee->code     = $code;
            $employee->name     = $request->name;
            $employee->fname    = $request->fname;
            $employee->mname    = $request->mname;
            $employee->mobile   = $request->mobile;
            $employee->address  = $request->address;
            $employee->gender   = $request->gender;
            $employee->religion = $request->religion;
            $employee->salary   = $request->salary;
            $employee->designation_id = $request->designation_id;
            $employee->dob      = date('Y-m-d',strtotime($request->dob));
            $employee->join_date = date('Y-m-d',strtotime($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_image'),$filename);
                $employee['image'] = $filename;
            }
            $employee->save();
            $employee_salary = new EmployeSalaryLog();
            $employee_salary->employee_id     = $employee->id;
            $employee_salary->effected_date   = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary  = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
        });
        return redirect()->route('employee-regi-view')->with('success','Data inserted Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['employees'] = User::find($id);
        $data['designations'] = Designation::all();
        return view('backend.employees.employee-regi.add_employee',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name     = $request->name;
        $user->mobile   = $request->mobile;
        $user->fname    = $request->fname;
        $user->mname    = $request->mname;
        $user->address  = $request->address;
        $user->gender   = $request->gender;
        $user->religion = $request->religion;
        $user->designation_id = $request->designation_id;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/employee_image/' . $user->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_image'), $filename);
            $user['image'] = $filename;
        }
        $user->save();
        return redirect()->route('employee-regi-view')->with('success','Data updated successfully!');
    }

    public function details($id){
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.employees.employee-regi.pdf_employee_details',$data);
        $pdf->setProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

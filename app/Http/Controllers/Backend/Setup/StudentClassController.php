<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function view(){
        $allData = StudentClass::all();
        return view('backend.setup.student_class.view_class',compact('allData'));
    }

    public function add(){
        return view('backend.setup.student_class.add_class');
    }

    public function store(Request $request){
        $this->validate($request,[
    		'name' 	  => 'required|unique:student_classes,name'
    	]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('student-class-view')->with('success','Data insert successfully!');
    }

    public function edit($id){
        $data = StudentClass::find($id);
        return view ('backend.setup.student_class.add_class',compact('data'));
    }

    public function update(Request $request, $id){
        $student = StudentClass::find($id);
        $this->validate($request,[
            'name' => 'required|unique:student_classes,name,' . $student->id
        ]);
       $student->name = $request->name;
       $student->update();
       return redirect()->route('student-class-view')->with('success','Data updated successfully!');
    }

    public function delete(Request $request, $id){
        $student = StudentClass::find($id);
        $student->delete();
        return redirect()->route('student-class-view')->with('success','Data Deleted successfully!');
    }


}


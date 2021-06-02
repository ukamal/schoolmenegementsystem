<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function view(){
        $groups = StudentGroup::all();
        return view('backend.setup.group.view_group',compact('groups'));
    }

    public function add(){
        return view('backend.setup.group.add_group');
    }

    public function store(Request $request){
        $this->validate($request,[
    		'name' 	  => 'required|unique:student_years,name'
    	]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('student-group-view')->with('success','Data insert successfully!');
    }

    public function edit($id){
        $groups = StudentGroup::find($id);
        return view('backend.setup.group.add_group',compact('groups'));
    }

    public function update(Request $request, $id){
        $data = StudentGroup::find($id);
        $this->validate($request,[
    		'name' 	  => 'required|unique:student_years,name,' . $data->id
    	]);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('student-group-view')->with('success','Data updated successfully!');
    }
}

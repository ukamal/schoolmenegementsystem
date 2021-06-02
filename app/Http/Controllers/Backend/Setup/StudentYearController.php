<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function view(){
        $years = StudentYear::all();
        return view('backend.setup.s_year.view_year',compact('years'));
    }

    public function add(){
        return view('backend.setup.s_year.add_year');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $sData = new StudentYear();
        $sData->name = $request->name;
        $sData->save();
        return redirect()->route('student-year-view')->with('success','Data inserted Successfully!');
    }

    public function edit($id){
        $years = StudentYear::find($id);
        return view('backend.setup.s_year.add_year',compact('years'));
    }

    public function update(Request $request, $id){
        $sData = StudentYear::find($id);
        $request->validate([
            'name' => 'required',
        ]);
        $sData->name = $request->name;
        $sData->update();
        return redirect()->route('student-year-view')->with('success','Data updated Successfully!');
    }
}

<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarksGrade;

class GradeController extends Controller
{
    public function view(){
        $data['grades'] = MarksGrade::all();
        return view('backend.marks.view_grade',$data);
    }

    public function add(){
        return view('backend.marks.add_grade');
    }

    public function store(Request $request){
        $grade = new MarksGrade();
        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remakrs = $request->remakrs;
        $grade->save();
        return redirect()->route('marks-grade-view')->with('success','Data inserted successfully!');
    }

    public function edit($id){
        $data['grades'] = MarksGrade::find($id);
        return view('backend.marks.add_grade',$data);
    }

    public function update(Request $request, $id){
        $grade = MarksGrade::find($id);
        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks  = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remakrs   = $request->remakrs;
        $grade->update();
        return redirect()->route('marks-grade-view')->with('success','Data updated successfully!');
    }
}

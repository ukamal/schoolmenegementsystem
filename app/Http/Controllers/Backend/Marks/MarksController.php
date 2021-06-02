<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\ExamType;

class MarksController extends Controller
{
    public function add(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.add_marks',$data);
    }

    public function store(Request $request){
        $studentcount = $request->student_id;
        if($studentcount){
            for($i=0; $i < count($request->student_id); $i++){
                $data = new StudentMarks();
                $data->year_id  = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no    = $request->id_no[$i];
                $data->marks    = $request->marks[$i];
                $data->save();
            }
        }
        
        return redirect()->back()->with('success','Marks inserted successfully!');
    }

    public function edit(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.marks_edit',$data);
    }

    public function getStudentMarks(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $getStudent = StudentMarks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();
        return response()->json($getStudent);
    }

    public function update(Request $request){
        StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)
        ->where('exam_type_id',$request->exam_type_id)->delete();
        $studentcount = $request->student_id;
        if($studentcount){
            for($i=0; $i < count($request->student_id); $i++){
                $data = new StudentMarks();
                $data->year_id  = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no    = $request->id_no[$i];
                $data->marks    = $request->marks[$i];
                $data->save();
            }
        }
        
        return redirect()->back()->with('success','Marks updated successfully!');
    }
}

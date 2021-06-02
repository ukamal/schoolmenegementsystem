<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function view(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.exam_type_view',$data);
    }

    public function add(){
        return view('backend.setup.exam_type.exam_type_add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:exam_types,name'
        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('exam-type-view')->with('success','Data inserted successfully!');
    }

    public function edit($id){
        $data['allData'] = ExamType::find($id);
        return view('backend.setup.exam_type.exam_type_add',$data);
    }

    public function update(Request $request, $id){
            $data = ExamType::find($id);
            $this->validate($request,[
                'name' => 'required|unique:exam_types,name,' . $data->id
            ]);
            $data->name = $request->name;
            $data->update();
            return redirect()->route('exam-type-view')->with('success','Data updated successfully!');
    }
}

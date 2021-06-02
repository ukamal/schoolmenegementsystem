<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\AssignSubject;
use Auth;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['classes'] = StudentClass::all();
        $data['subjects'] = Subject::all();
        return view('backend.setup.assign_subject.add_assign_subject',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjectCount = Count($request->subject_id);
        if ($subjectCount != NULL) {
            for ($i=0; $i < $subjectCount; $i++) { 
                $assignSub = new AssignSubject();
                $assignSub->class_id   = $request->class_id;
                $assignSub->subject_id = $request->subject_id[$i];
                $assignSub->full_mark  = $request->full_mark[$i];
                $assignSub->pass_mark  = $request->pass_mark[$i];
                $assignSub->subjective_mark = $request->subjective_mark[$i];
                $assignSub->save();
            }
        }
        return redirect()->route('view-assign-subject')->with('success','Data Inserted Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $data['allData'] = AssignSubject::where('class_id',$class_id)->get();
        $data['classes'] = StudentClass::all();
        $data['subjects'] = Subject::all();
        return view('backend.setup.assign_subject.edit_assign_subject',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {
        if ($request->subject_id==NULL) {
            return redirect()->back()->with('error','Sorry! You don not select any item');
        }else{
            AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
            foreach($request->subject_id as $key => $value){
                $assin_subject_exist = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                if($assin_subject_exist){
                    $assignSub = $assin_subject_exist;
                }else{
                    $assignSub = new AssignSubject();
                }
                $assignSub->class_id = $request->class_id;
                $assignSub->subject_id = $request->subject_id[$key];
                $assignSub->full_mark = $request->full_mark[$key];
                $assignSub->pass_mark = $request->pass_mark[$key];
                $assignSub->subjective_mark = $request->subjective_mark[$key];
                // $assignSub->updated_by = Auth::user()->id;
                $assignSub->save();
            }
        }
        return redirect()->route('view-assign-subject')->with('success','Data updated Successfully!');
    }

   
    public function details($class_id)
    {
        $data['allData'] = AssignSubject::where('class_id',$class_id)->get();
        return view('backend.setup.assign_subject.details_assign_subject',$data);
    }
}

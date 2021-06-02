<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function view(){
        $shifts = Shift::all();
        return view('backend.setup.shift.view_shift',compact('shifts'));
    }

    public function add(){
        return view('backend.setup.shift.add_shift');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:shifts,name'
        ]);
        $data = new Shift();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('student-shift-view')->with('success','Data insert Successfully!');
    }

    public function edit($id){
        $shifts = Shift::find($id);
        return view('backend.setup.shift.add_shift',compact('shifts'));
    }

    public function update(Request $request, $id){
        $data = Shift::find($id);
        $this->validate($request,[
            'name' => 'required|unique:shifts,name,' . $data->id
        ]);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('student-shift-view')->with('success','Data updated Successfully!');
    }

}

<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function view(){
        $designations = Designation::all();
        return view('backend.setup.designation.view_designation',compact('designations'));
    }

    public function add(){
        return view('backend.setup.designation.add_designation');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:designations,name'
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('view-designation')->with('success','Data inserted successfully!');
    }

    public function edit($id){
        $designations = Designation::find($id);
        return view('backend.setup.designation.add_designation',compact('designations'));
    }

    public function update(Request $request, $id){
        $data = Designation::find($id);
        $this->validate($request,[
            'name' => 'required|unique:designations,name,' . $data->id
        ]);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('view-designation')->with('success','Data update successfully!');
    }
}

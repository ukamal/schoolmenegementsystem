<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCat;

class FeeCatController extends Controller
{
    public function view(){
        $sfeecats = FeeCat::all();
        return view('backend.setup.fee_category.sfee_category_view',compact('sfeecats'));
    }

    public function add(){
        return view('backend.setup.fee_category.sfee_category_add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:fee_cats,name'
        ]);
        $sData = new FeeCat();
        $sData->name = $request->name;
        $sData->save();
        return redirect()->route('fee-category-view')->with('success','Data insert successfully!');
    }

    public function edit($id){
        $editData = FeeCat::find($id);
        return view('backend.setup.fee_category.sfee_category_add',compact('editData'));
    }

    public function update(Request $request, $id){
        $sData = FeeCat::find($id);
        $this->validate($request,['name' => 'required|unique:fee_cats,name,' . $sData->id ]);
        $sData->name = $request->name;
        $sData->update();
        return redirect()->route('fee-category-view')->with('success','Data updated successfully!');
    }

}

<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\OtherCost;

class OthersCostController extends Controller
{
    public function view(){
        $data['allData'] = OtherCost::orderBy('id','desc')->get();
        return view('backend.account.othercost.view_other_cost',$data);
    }

    public function add(){
        return view('backend.account.othercost.add_other_cost');
    }

    public function store(Request $request){
        $cost = new OtherCost();
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        if($request->file('image')){
            $file = $request->file('image');
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_image'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();
        return redirect()->route('others-cost-view')->with('success','Data inserted successfully');
    }

    public function edit($id){
        $data['allData'] = OtherCost::find($id);
        return view('backend.account.othercost.add_other_cost',$data);
    }

    public function update(Request $request, $id){
        $cost = OtherCost::find($id);
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->amount = $request->amount;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/cost_image/'.$cost->image));
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_image'),$filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->update();
        return redirect()->route('others-cost-view')->with('success','Data updated successfully');
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function view(){
    	$allData = User::where('user_type','admin')->get();
    	return view('backend.user.view_user',compact('allData'));
    }

    public function add(){
    	return view('backend.user.add_user');
    }

    public function store(Request $request){
		$code = rand(000000000,999999999);
     	$data = new User();
    	$data->user_type = 'admin';
    	$data->role 	= $request->role;
    	$data->name 	= $request->name;
    	$data->email 	= $request->email;
    	$data->password = bcrypt($code);
		$data->code = $code;
    	$data->save();
    	return redirect()->route('view-user')->with('success','Data inserted successfully!');
    }

    public function edit($id){
		$editData = User::find($id);
    	return view('backend.user.edit_user',compact('editData'));
    }

    public function update(Request $request, $id){
        $data = User::find($id);
    	$data->name 	= $request->name;
    	$data->email 	= $request->email;
		$data->role 	= $request->role;
    	$data->update();
    	return redirect()->route('view-user')->with('success','Data updated successfully!');
    }

    public function delete($id){
    	$delData = User::find($id);
    	$delData->delete();
    	return redirect()->route('view-user')->with('success','Data deleted successfully!');
    }
}

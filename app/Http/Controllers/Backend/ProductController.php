<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function view(){
    	$products = Product::all();
    	return view('backend.product.view_product',compact('products'));
    }

    public function add(){
    	return view ('backend.product.add_product');
    }

    public function store(Request $request){
    	// $this->validate($request,[
    	// 	'title' 	  => 'required',
    	// 	'description' => 'required',
    	// 	'price' 	  => 'required',
    	// ]);
    	$data = new Product();
    	$data->title 	   = $request->title;
    	$data->description = $request->description;
    	$data->price 	   = $request->price;
    	if ($request->file('image')) {
            $file = $request->file('image');
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/upload/backend_imgs'),$filename);
            $data['image']= $filename;
        }
    	$data->save();
    	return redirect()->route('view-product')->with('success','Data insert successfully!');
    }

    public function edit($id){
    	$editData = Product::find($id);
    	return view ('backend.product.edit_product',compact('editData'));
    }

    public function update(Request $request, $id){
    	$data = Product::find($id);
    	$data->title = $request->title;
    	$data->description = $request->description;
    	$data->price = $request->price;
    	if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('/upload/backend_imgs/'.$data->image));
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/upload/backend_imgs'),$filename);
            $data['image']= $filename;
        }
    	$data->update();
    	return redirect()->route('view-product')->with('success','Data updated successfully!');
    }

    public function delete($id){
		$data = Product::find($id);
		if(file_exists('public/upload/backend_imgs/' . $data->image) AND ! empty($data->image)){
            unlink('public/upload/backend_imgs/' . $data->image);
        }
    	$data->delete();
    	return redirect()->route('view-product')->with('success','Data deleted successfully!');
    }
}

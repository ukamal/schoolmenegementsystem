<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\FeeCat;
use App\Models\FeeCatAmount;

class FeeCatAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $amounts = FeeCatAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_cat__amount.fee_amount_view',compact('amounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['feeCategories'] = FeeCat::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_cat__amount.fee_amount_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for($i=0; $i < $countClass; $i++){
                $fee_amount = new FeeCatAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id        = $request->class_id[$i];
                $fee_amount->amount          = $request->amount[$i];
                $fee_amount->save();
            }
        }
        return redirect()->route('fee-cat-amount-view')->with('success','Data inserted successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_category_id)
    {
       $data['amounts']      = FeeCatAmount::where('fee_category_id',$fee_category_id)->get();
       $data['feeCategories'] = FeeCat::all();
       $data['classes']       = StudentClass::all();
       return view('backend.setup.fee_cat__amount.edit_fee_amount',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_category_id)
    {
        if ($request->class_id==NULL) {
            return redirect()->back()->with('error','Sorry you do not any item');
        }else{
            FeeCatAmount::where('fee_category_id',$fee_category_id)->delete();
            $countClass = count($request->class_id);
            for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new FeeCatAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        return redirect()->route('fee-cat-amount-view')->with('success','Data Updated successfully!');
    }

    public function details($fee_category_id){
        $data['amounts']      = FeeCatAmount::where('fee_category_id',$fee_category_id)->get();
        return view('backend.setup.fee_cat__amount.details_fee_amount',$data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

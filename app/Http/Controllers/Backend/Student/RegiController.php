<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\Shift;
use DB;
use PDF;

class RegiController extends Controller
{
    public function view(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        // dd($data['year_id']);
        $data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_regi.view_student',$data);
    }

    public function studentWiseSearch(Request $request){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
       
        return view('backend.student.student_regi.view_student',$data);
    }

    public function add(){
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = Shift::all();
        return view('backend.student.student_regi.add_student',$data);
    }

    public function store(Request $request){
       DB::transaction(function() use($request){
        $checkYear = StudentYear::find($request->year_id)->name;
        $student = User::where('user_type','student')->orderBy('id','DESC')->first();
        if($student == NULL){
            $firstRegi = 0;
            $studentId = $firstRegi + 1;
            if($studentId < 10){
                $id_no = '000' . $studentId;
            }elseif($studentId < 100){
                $id_no = '00' . $studentId;
            }elseif($studentId < 1000){
                $id_no = '0' . $studentId;
            }
        }else{
            $student = User::where('user_type','student')->orderBy('id','DESC')->first()->id;
            $studentId = $student + 1;
            if($studentId < 10){
                $id_no = '000' . $studentId;
            }elseif($studentId < 100){
                $id_no = '00' . $studentId;
            }elseif($studentId < 1000){
                $id_no = '0' . $studentId;
            }
        }
        $final_id_no = $checkYear . $id_no;

        $user = new User();
        $code = rand(000000,999999);
        $user->password = bcrypt($code);
        $user->code = $code;
        $user->id_no = $final_id_no;
        $user->user_type = 'student';
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->dob = date('Y-d-m',strtotime($request->dob));
        if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/backend_imgs'),$filename);
            $user['image'] = $filename;
        }
        $user->save();

        $assign_student = new AssignStudent();
        $assign_student->student_id = $user->id;
        $assign_student->class_id = $request->class_id;
        $assign_student->year_id = $request->year_id;
        $assign_student->group_id = $request->group_id;
        $assign_student->shift_id = $request->shift_id;
        $assign_student->save();

        $discount = new DiscountStudent();
        $discount->assign_student_id = $assign_student->id;
        $discount->fee_category_id = '1';
        $discount->discount = $request->discount;
        $discount->save();
       });
       return redirect()->route('view-registration')->with('success','Data inserted succesfully!');
    }

    public function edit($student_id){
       $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
       //dd($data['editData']->toArray());
       $data['years'] = StudentYear::orderBy('id','desc')->get();
       $data['classes'] = StudentClass::all();
       $data['groups'] = StudentGroup::all();
       $data['shifts'] = Shift::all();
       return view('backend.student.student_regi.add_student',$data);
    }

    public function update(Request $request, $student_id){
        DB::transaction(function() use($request,$student_id){
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-d-m',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/backend_imgs/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/backend_imgs'),$filename);
                $user['image'] = $filename;
            }
            $user->save();
    
            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();
    
            $discount = DiscountStudent::where('assign_student_id',$request->id)->first();
          
            $discount->discount = $request->discount;
            $discount->save();
           });
           return redirect()->route('view-registration')->with('success','Data Updated succesfully!');
    }

    public function promotion($student_id){
        $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        //dd($data['editData']->toArray());
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = Shift::all();
        return view('backend.student.student_regi.class_promotion',$data);
     }

     public function promotionStore(Request $request, $student_id){
        DB::transaction(function() use($request,$student_id){
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-d-m',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/backend_imgs/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/backend_imgs'),$filename);
                $user['image'] = $filename;
            }
            $user->save();
    
            $assign_student = new AssignStudent();
            
            $assign_student->student_id = $request->student_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();
    
            $discount = new DiscountStudent();
            $discount->assign_student_id = $assign_student->id;
            $discount->fee_category_id = '1';
            $discount->discount = $request->discount;
            $discount->save();
           });
           return redirect()->route('view-registration')->with('success','Class Promotion succesfully!');
    }

    public function details($student_id){
        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('backend.student.student_regi.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }


}




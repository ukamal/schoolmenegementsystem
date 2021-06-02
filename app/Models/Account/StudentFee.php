<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\FeeCat;

class StudentFee extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

    public function fee_category(){
        return $this->belongsTo(FeeCat::class, 'fee_category_id','id');
    }
    
}

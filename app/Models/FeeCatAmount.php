<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCatAmount extends Model
{
    public function fee_category(){
        return $this->belongsTo(FeeCat::class, 'fee_category_id', 'id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id','id');
    }

    
}

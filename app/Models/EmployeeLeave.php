<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{

    public function user(){
        return $this->belongsTo(User::class,'emloyee_id','id');
    }
    public function purpose(){
        return $this->belongsTo(EmployeeLeavePurpose::class,'leave_purpose_id','id');
    }
}

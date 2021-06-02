<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmployeeSalary extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class,'employee_id','id');
    }
}

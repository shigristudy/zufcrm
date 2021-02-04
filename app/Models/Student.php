<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;

    public function donations(){
        return $this->hasMany(StudentDonation::class,'student_id','id');
    }

    public function statuses(){
        return $this->hasMany(StudentStatus::class,'student_id','id');
    }
}

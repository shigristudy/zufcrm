<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDonation extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(WooOrder::class,'order_id','id');
    }
}

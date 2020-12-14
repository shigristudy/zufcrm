<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationLine extends Model
{
    use HasFactory,SoftDeletes;

    public function project(){
        return $this->belongsTo(WooProduct::class,'project_id','product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory,SoftDeletes;

    public function donationlines(){
        return $this->hasMany(DonationLine::class,'donation_id','id');
    }

    public function amount(){
        return $this->hasMany(DonationLine::class,'donation_id','id')->sum('amount');
    }
}

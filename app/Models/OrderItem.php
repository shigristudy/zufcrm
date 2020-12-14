<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(WooProduct::class,'product_id','product_id');
    }

    public function order(){
        return $this->belongsTo(WooOrder::class,'order_id','id');
    }
}

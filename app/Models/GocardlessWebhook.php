<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GocardlessWebhook extends Model
{
    use HasFactory;

    protected $table = 'gocardless_webhook_calls';

    public function order(){
        return $this->belongsTo(WooOrder::class,'order_id','order_id');
    }
}

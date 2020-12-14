<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WooOrder extends Model
{
    protected $cast = ["donation_date"=> "DATE"];
    use HasFactory;

    public function items(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function sponsor_items(){
        return $this->hasMany(OrderItem::class,'order_id','id')->whereIn('order_items.product_id',[11863, 11864, 11814, 11815, 11816]);
    }

    // Scopes

    public function ScopeGiftaid($query){
        return $query->where('gift_aid','Yes')
                    ->orWhere('gift_aid','verbal')
                    ->orWhere('gift_aid','written')
                    ->orWhere('gift_aid','online');
    }

    public function ScopeClaimed($query){
        return $query->where('claimed','!=',null);
    }

    public function ScopeNotClaimed($query){
        return $query->where('claimed',null);
    }

    public function ScopeSubmitted($query){
        return $query->where('submitted','!=',null);
    }

    public function ScopeNotSubmitted($query){
        return $query->where('submitted',null);
    }

    public function ScopeOfGiftAidType($query,$type){
        return $query->where('gift_aid', $type);
    }
    
}

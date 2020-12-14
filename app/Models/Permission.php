<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;
class Permission extends LaratrustPermission
{
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function parentPermission(){
        return $this->belongsTo(Permission::class,'parent','id');
    }

    public function children(){
        return $this->hasMany( self::class, 'parent', 'id' );
    }

}

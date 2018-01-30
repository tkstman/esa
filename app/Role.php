<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    public $primaryKey = 'role_id';
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id', 
    ];
}

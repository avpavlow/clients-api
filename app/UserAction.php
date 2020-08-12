<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_method',
        'urn',
        'payload',
        'user_id',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];
}

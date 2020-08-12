<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'surname' => 'integer',
        'phone' => 'integer',
        'email' => 'integer',
    ];

    /**
     * Load all  and paginate
     *
     * @return Paginator
     */
    public static function loadAll(): Paginator
    {
        return static::latest()
            ->paginate();
    }



}

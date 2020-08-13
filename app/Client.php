<?php

namespace App;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Client extends Model
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
        'surname' => 'string',
        'phone' => 'string',
        'email' => 'string',
    ];



    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  string  $keyword
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWhereFullname($builder, $keyword)
    {
        $builder->where(DB::raw('concat(name," ",surname)'), 'LIKE', '%' . $keyword . '%');
    }


    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  string  $keyword
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWherePhone($builder, $keyword)
    {
        $builder->where('phone', 'LIKE',  '%' . $keyword . '%');
    }


    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  string  $keyword
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeWhereEmail($builder, $keyword)
    {
        $builder->where('email', 'LIKE',  '%' . $keyword . '%');
    }
}

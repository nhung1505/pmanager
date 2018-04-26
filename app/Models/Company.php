<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'company_image',
        'user_id',
        'days',

    ];

    public function user(){
        return $this->belongsTo('App\User');

    }

    public function projects(){
        return $this->hasMany('App\Models\Project');
    }
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');

    }
}

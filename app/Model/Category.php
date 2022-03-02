<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    /**
     * Relationship with posts 
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }
}

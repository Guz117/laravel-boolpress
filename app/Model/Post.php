<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relationship with category 
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

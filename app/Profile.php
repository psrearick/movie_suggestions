<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/profiles/{$this->id}";
    }

    public function setActive()
    {
        session(['profile' => $this->id]);
    }

    public function isActive()
    {
        return session('profile') == $this->id;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movies()
    {
        return $this
            ->belongsToMany('App\Movie')
            ->withPivot('watch_list', 'favorite', 'seen', 'rating');
    }

    public function addMovie($movie, $vars)
    {
        return $this->movies()->attach($movie, array_filter($vars));
    }
}

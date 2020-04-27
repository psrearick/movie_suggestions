<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/movies/{$this->id}";
    }

    public function profiles()
    {
        return $this
            ->belongsToMany('App\Profile')
            ->withPivot('watch_list', 'favorite', 'seen', 'rating');
    }
}

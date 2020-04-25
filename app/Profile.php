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
}

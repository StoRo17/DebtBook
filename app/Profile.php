<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    protected $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['first_name', 'last_name', 'avatar'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

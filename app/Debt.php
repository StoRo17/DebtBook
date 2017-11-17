<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['amount', 'currency', 'name', 'type', 'comment'];
}

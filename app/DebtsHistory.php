<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebtsHistory extends Model
{
    protected $fillable = ['amount', 'type', 'comment'];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebtsHistory extends Model
{
    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}

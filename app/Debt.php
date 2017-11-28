<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['total_amount', 'currency', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(DebtsHistory::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}

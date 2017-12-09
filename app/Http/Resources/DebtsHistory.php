<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DebtsHistory extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'type' => $this->type,
            'comment' => $this->comment,
        ];
    }
}

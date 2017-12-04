<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Debt extends Resource
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
            'total_amount' => $this->total_amount,
            'currency_id' => $this->currency_id,
            'name' => $this->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

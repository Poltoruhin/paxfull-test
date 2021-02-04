<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TradeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'amount' => number_format(($this->amount / 10**8) * $this->rate, 2),
            'rate' => $this->rate,
            'payment_method' => $this->payment_method_name,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'buyer' => $this->buyer
        ];
    }
}

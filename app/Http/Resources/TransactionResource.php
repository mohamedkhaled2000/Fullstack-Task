<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'amount'            => $this->amount,
            'currency'          => $this->currency,
            'status'            => $this->status,
            'payment_method'    => $this->payment_method,
            'transaction_date'  => $this->transaction_date,
            'paid_at'           => $this->paid_at,
            'user'              => UserResource::make($this->whenLoaded('user')),
            'created_at'        => $this->created_at
        ];
    }
}

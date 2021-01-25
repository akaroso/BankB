<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentStorageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'BankNo' =>$this->BankNo,
            'PaymentSum' =>$this->PaymentSum,
            'Payments' =>PaymentResource::collection($this->whenLoaded('Payments')),
        ];
    }
}

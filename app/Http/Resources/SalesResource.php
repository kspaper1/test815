<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            'id' => $this->id,
            'invoiceId' => $this->invoiceId,
            'product' => $this->product,
            'employee' => $this->employee,
            'customer' => $this->customer,
            'date' => $this->date
        ];
    }
}

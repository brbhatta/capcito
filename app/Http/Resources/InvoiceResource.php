<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'invoice_nr' => $this->getInvoiceNumber(),
            'dates' => $this->getDates(),
            'currency' => $this->getCurrency(),
            'total_amount' => $this->getTotalAmount(),
            'custom_notes' => $this->getCustomNotes(),
            'rows' => $this->getRows()
        ];
    }
}

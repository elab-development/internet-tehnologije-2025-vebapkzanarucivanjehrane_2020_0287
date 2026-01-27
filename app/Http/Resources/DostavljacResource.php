<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

//resource se koristi za formatiranje podataka koji se vracaju iz API-ja

class DostavljacResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ime' => $this->ime,
            'kontakt' => $this->kontakt,
        ]; 
    }
}

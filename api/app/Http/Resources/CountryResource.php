<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Country' => $this->country,
            'TotalConfirmed' => $this->total_confirmed,
            'TotalRecovered' => $this->total_recovered,
            'TotalDeaths' => $this->total_deaths,
        ];
    }
}

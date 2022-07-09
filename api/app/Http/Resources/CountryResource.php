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
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'totalConfirmed' => $this->total_confirmed,
            'totalRecovered' => $this->total_recovered,
            'totalDeaths' => $this->total_deaths,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }
}

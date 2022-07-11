<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class VacationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return Arr::whereNotNull([
            'id' => $this->id,
            'type' => $this->type->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
//            'user' => UserResource::make($this->user)
        ]);
    }
}

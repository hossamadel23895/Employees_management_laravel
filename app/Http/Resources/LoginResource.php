<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this[0]->id,
            'name' => $this[0]->name,
            'email' => $this[0]->email,
            'role' => RoleResource::make($this[0]->roles->first()),
            'token' => TokenResource::make($this[1])
        ];
    }
}

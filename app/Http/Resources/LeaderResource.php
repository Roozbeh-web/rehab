<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaderResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'avatar' => $this->profile->image,
            'quit_date' => $this->profile->quit_date,
            'birth_date' => $this->profile->birth_date,
            'bio' => $this->profile->bio,
            'province' => $this->province,
            'city' => $this->city,
        ];
    }
}

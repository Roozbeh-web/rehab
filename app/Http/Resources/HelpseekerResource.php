<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HelpseekerResource extends JsonResource
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
            'id' => $this->helpseeker->id,
            'first_name' => $this->helpseeker->first_name,
            'last_name' => $this->helpseeker->last_name,
            'username' => $this->helpseeker->username,
            'avatar' => $this->helpseeker->profile->image,
            'birth_date' => $this->helpseeker->profile->birth_date,
            'bio' => $this->helpseeker->profile->bio,
            'province' => $this->helpseeker->province,
            'city' => $this->helpseeker->city,
            'drugs' => $this->helpseeker->drugs->toArray(),
        ];
    }
}

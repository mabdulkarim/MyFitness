<?php

namespace App\Http\Resources\Users;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMeasurementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'weight' => $this->weight,
            'body_fat_percentage' => $this->body_fat_percentage,
            'created_at' => $this->created_at,
        ];
    }
}

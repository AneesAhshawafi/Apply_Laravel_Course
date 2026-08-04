<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Controll the returned fields
        // Only the mentioned fields will be returned
        // You Can also change the fields names
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "title" => $this->name,
            "status" => $this->active ? "Active" : "Inactive",
            "release date" => $this->created_at
        ];
    }
}

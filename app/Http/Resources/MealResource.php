<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => (!empty($this->deleted_at) ? 'deleted' : ($this->created_at == $this->updated_at ? 'created' : 'updated')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
        ];
    }
}

<?php

namespace App\Http\Resources;
use App\User;
use App\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tittle' => $this->tittle,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user'=>"/api/users/" . $this->user_id,
            'category'=>"/api/categories/" .$this->category_id,
        ];
    }
}

<?php

namespace App\Http\Resources\Portfolio;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'link'=>$this->link,
            'date'=>$this->date,
            'category_id'=>$this->category_id,
            'img'=>$this->img,
            'created_at'=>$this->created_at,
            'user_first_name'=>$this->user->first_name,
            'user_last_name'=>$this->user->last_name,
            'user_img'=>$this->user->user_img,
            'tags' => $this->whenPivotLoaded('tags', function () {
                return $this->tags->name;
            }),
        ];
    }
}

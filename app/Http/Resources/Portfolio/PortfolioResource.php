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
            'user_id'=>$this->user_id,
            'user_name'=>$this->user_name,
            'user_img'=>$this->user_img,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'link'=>$this->link,
            'date'=>$this->date,
            'skills'=>$this->skills,
            'category'=>$this->category,
            'img'=>$this->img
        ];
    }
}

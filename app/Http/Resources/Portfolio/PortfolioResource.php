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
            'user_first_name'=>$this->user_first_name,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'link'=>$this->link,
            'date'=>$this->date,
            'skills'=>$this->skills,
            'img'=>$this->img
        ];
    }
}

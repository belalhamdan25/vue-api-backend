<?php

namespace App\Http\Resources\Portfolio;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // 'user_id'=>$this->user_id,
            // 'title'=>$this->title,
            // 'desc'=>$this->desc,
            // 'link'=>$this->link,
            // 'date'=>$this->date,
            // 'category_id'=>$this->category_id,
            // 'img'=>$this->img,
            // 'user_first_name'=>$this->user->first_name,
            // 'user_last_name'=>$this->user->last_name,
            // 'user_img'=>$this->user->user_img,
        ];
    }
}



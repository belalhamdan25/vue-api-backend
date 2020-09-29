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
            'user_name'=>$this->user_name,
            'user_img'=>$this->user_img,
            'title'=>$this->title,
            'img'=>$this->img,
            'desc'=>$this->desc,
        ];
    }
}



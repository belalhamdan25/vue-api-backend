<?php

namespace App\Http\Resources\Freelancer;

use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerCollection extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->first_name." ".$this->last_name,
            'user_img'=>$this->user_img,
            'location'=>$this->location,
            'category'=>$this->category->desc,
            'rate'=>$this->rate
        ];
    }
}



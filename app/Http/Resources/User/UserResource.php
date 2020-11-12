<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_name'=>$this->first_name." ".$this->last_name,
            'user_img'=>$this->user_img,
            'location'=>$this->location,
            'rate'=>$this->rate,
            'category'=>$this->category->desc,
            'created_at'=>$this->created_at,
            'about'=>$this->about,
            'portfolios'=>$this->portfolios,
            'projects'=>$this->projects,
            'user_offers'=>$this->projectOffers,
            'skills'=>$this->tags,

        ];
    }
}

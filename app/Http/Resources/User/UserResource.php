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
            'role_name'=>$this->role_name,
            'about'=>$this->about,
            'portfolios'=>$this->portfolios()->with('portfolioImages')->get(),
            'portfolios_count'=>$this->portfolios->count(),
            'projects'=>$this->projects,
            'projects_count'=>$this->projects->count(),
            'user_offers'=>$this->projectOffers()->with('project')->get(),
            'user_offers_count'=>$this->projectOffers->count(),
            'skills'=>$this->tags,
            'skills_count'=>$this->tags->count(),

        ];
    }
}

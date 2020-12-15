<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class MyPortfoliosResource extends JsonResource
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
            'portfolios'=>$this->portfolios()->with('portfolioImages')->get(),
        ];
    }
}

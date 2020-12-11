<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'budget'=>$this->budget,
            'time_line'=>$this->time_line,
            'created_at'=>$this->created_at,
            'user_name'=>$this->user->first_name." ".$this->user->last_name,
            'user_img'=>$this->user->user_img,
            'offers_count'=>$this->projectOffers->count(),
            // 'offers'=>$this->projectOffers,
            'skills'=>$this->tags,
            'attachments'=>$this->projectAttachments,
            'category'=>$this->category
        ];
    }
}

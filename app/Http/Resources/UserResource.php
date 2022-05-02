<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if($this->photo === null){
            $photo = asset('img/user.png');
        }else{
            $photo = asset('storage/user/'.$this->photo);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $photo,
            'showTime' => $this->created_at->format("d M Y"),
        ];
    }
}

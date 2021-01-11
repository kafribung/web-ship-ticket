<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"         => $this->id,
            "ship"       => $this->ship,
            "departure"  => $this->departure,
            "destination"=> $this->destination,
            "date"       => date('d M Y', strtotime($this->date)),
            "time"       => date("h:i" ,strtotime($this->time)), 
        ];
    }
}

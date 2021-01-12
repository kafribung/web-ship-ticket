<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id'       => $this->id,
            'identity' => $this->identity,
            'age'      => $this->age,
            'city'     => $this->city,
            'gender'   => $this->gender,
            'status'   => $this->status,
            'budget'   => $this->budget,
            'schedule' => ScheduleResource::make($this->schedule),
            'service'  => $this->service->type,
            'vehicle'  => $this->vehicle()->get(['type', 'budget']),
        ];
    }
}

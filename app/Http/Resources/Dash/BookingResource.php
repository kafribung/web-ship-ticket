<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'identity' => $this->identity,
            'age'      => $this->age,
            'city'     => $this->city,
            'gender'   => $this->gender,
            'status'   => $this->status,
            'schedule' => $this->schedule->id,
            'service'  => $this->service->id,
            'vehicle'  => ($this->service->id == 2 ? $this->vehicle->id : $this->vehicle),
        ];
    }
}

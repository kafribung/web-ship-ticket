<?php

namespace App\Http\Resources\Dash;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'name' => $this->name,
            'email'   => $this->email,
            'admin' => $this->admin,
            'schedule' => $this->schedule,
            'booking' => $this->booking,
            'customer' => $this->customer,
        ];
    }
}

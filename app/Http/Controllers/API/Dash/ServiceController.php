<?php

namespace App\Http\Controllers\API\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dash\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __invoke()
    {
        $services = Service::get();
        return ServiceResource::collection($services);
    }
}

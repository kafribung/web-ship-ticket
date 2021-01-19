<?php

namespace App\Http\Controllers\API\Dash;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class DeleteBookingController extends Controller
{
    public function __invoke()
    {
        Customer::where('created_at', '>=' , Carbon::now()->addHour(2))->delete();
        return response()->json([ "message" => "The item was delete successfully"], 204);
    }
}

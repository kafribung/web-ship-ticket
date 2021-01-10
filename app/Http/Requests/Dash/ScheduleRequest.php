<?php

namespace App\Http\Requests\Dash;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ship'      => 'required|string|min:5|max:30',
            'departure' => 'required|string|min:3|max:30',
            'destination' => 'required|string|min:3|max:30',
            'date'      => 'required|date',
            'time'      => 'required'
        ];
    }
}

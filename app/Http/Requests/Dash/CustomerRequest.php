<?php

namespace App\Http\Requests\Dash;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name'    => ['required', 'string', 'min:3', 'max:30'],
            'identity'=> ['required', 'string', 'min:8', 'max:17'],
            'age'     => ['required', 'max:3'],
            'city'    => ['required', 'string', 'min:3', 'max:20'],
            'gender'  => ['required', 'string', 'min:4', 'max:6'],
            'schedule'=> 'required',
            'service' => 'required',
        ];
    }
}

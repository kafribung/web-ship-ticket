<?php

namespace App\Http\Requests\Dash;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'     => 'required|string|min:3|max:20',
            'email'    => 'required|email|unique:users,email,'. optional($this->user)->id,
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}

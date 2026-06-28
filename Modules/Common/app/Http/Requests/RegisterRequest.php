<?php

namespace  Modules\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'username'  => 'sometimes|nullable|string|alpha_dash|min:3|max:50|unique:users,username',
            'mobile'    => 'sometimes|unique:users',
            'password'  => 'required|min:8',
            'code'      => 'required|string',
            'school_id' => 'required|exists:schools,id',
        ];
    }
}

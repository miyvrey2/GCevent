<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class adminSaveUserRequest extends FormRequest
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
            'username'          => 'required|string|max:255',
            'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->segment(3), 'id')],
            'password'          => 'nullable|string|min:6|confirmed',
            'active'            => 'required|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrUpdateExhibition extends FormRequest
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
            'title'         => ['required', 'string', Rule::unique('genres')->ignore($this->segment(3), 'slug')],
            'slug'          => ['required', 'string', Rule::unique('genres')->ignore($this->segment(3), 'slug')],
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
        ];
    }
}

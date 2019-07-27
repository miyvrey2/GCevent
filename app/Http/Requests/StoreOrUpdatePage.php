<?php

namespace App\Http\Requests;

use App\Rules\Stringdatetime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrUpdatePage extends FormRequest
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
            'title'         => 'required',
            'subtitle'      => 'nullable|string',
            'slug'          => 'required',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'published_at'  => 'nullable|date_format:"Y-m-d\TH:i"',
            'offline_at'    => 'nullable|date_format:"Y-m-d\TH:i"',
            'keywords'      => 'nullable|array',
            'source'        => 'nullable|string',
            'image'         => 'nullable|string',
        ];
    }
}

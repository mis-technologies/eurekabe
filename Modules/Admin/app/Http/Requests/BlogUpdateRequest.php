<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'title'=> 'nullable|string',
            'content'=> 'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|string',
            'category_id'=> 'nullable|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}

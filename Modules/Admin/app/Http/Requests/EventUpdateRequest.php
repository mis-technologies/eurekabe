<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

                'title' => 'required|string|max:255',
                'cta_text' => 'nullable|string|max:255',
                'type' => 'required|string|max:255',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after_or_equal:start_datetime',
                'location' => 'nullable|string|max:255',
                'price' => 'nullable',
                'description' => 'nullable|string',
                'special_bonus' => 'nullable|string|max:255',
                'reg_link' => 'nullable|url|max:255',
                'status' => 'nullable',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

                'speakers' => 'nullable|array',
                'speakers.*.name' => 'string|max:255',
                'speakers.*.title' => 'nullable|string|max:255',
                'speakers.*.img_url' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                'speakers.*.img_urll' => 'nullable',

                'sponsors' => 'nullable|array',
                'sponsors.*.name' => 'string|max:255',
                'sponsors.*.logo_url' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                'sponsors.*.logo_urll' => 'nullable',

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

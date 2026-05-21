<?php

namespace Modules\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StartConversationRequest extends FormRequest
{
    public function authorize()
    {
        // If needed, you can add logic to authorize the request
        return true;
    }

    public function rules()
    {
        return [
            'text' => 'string|sometimes',
            'recipient_type' => ['required', 'string', Rule::in(['user', 'school'])],
            'recipient_id' => ['required', $this->recipientIdValidation()],
        ];
    }

    /**
     * Get the validation rule for the recipient_id based on recipient_type.
     *
     * @return \Closure
     */
    protected function recipientIdValidation()
    {
        return function ($attribute, $value, $fail) {
            if ($this->recipient_type === 'user') {
                if (!DB::table('users')->where('id', $value)->exists()) {
                    $fail('The selected recipient_id is invalid for a user.');
                }
            } elseif ($this->recipient_type === 'school') {
                if (!DB::table('schools')->where('id', $value)->exists()) {
                    $fail('The selected recipient_id is invalid for a school.');
                }
            } else {
                $fail('The recipient_type is invalid.');
            }
        };
    }

    public function messages()
    {
        return [
            'recipient_type.required' => 'The recipient type is required.',
            'recipient_type.in' => 'The recipient type must be either user or school.',
            'recipient_id.required' => 'The recipient ID is required.',
        ];
    }
}

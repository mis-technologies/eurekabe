<?php

namespace Modules\Student\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitStudentExamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'submissions'              => 'required|array',
            'submissions.*.question_id' => 'required|integer',
            'submissions.*.answer'      => 'required',
            'submissions.*.answer_type' => 'sometimes|string|in:mcq,essay',
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

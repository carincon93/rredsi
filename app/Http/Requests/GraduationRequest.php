<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GraduationRequest extends FormRequest
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
            'is_graduated'                  => ['required', 'boolean'],
            'year'                          => ['required', 'numeric', 'min:0', 'max:2100'],
            'educational_institution_id'    => ['required', 'numeric', 'exists:educational_institutions,id'],
            'academic_program_id'           => ['required', 'numeric', 'exists:academic_programs,id']
        ];
    }
}

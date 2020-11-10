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
            'is_graduated'          => 'required|boolean',
            'year'                  => 'required|numeric|min:0|max:9999999999',
            'academic_program_id'   => 'required|numeric|min:0|max:9999999999|exists:academic_programs,id',
            'user_id'               => 'required|numeric|min:0|max:9999999999|exists:users,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->is_graduated != null) {
            $this->merge([
                'is_graduated' => (boolean) $this->is_graduated,
            ]);
        }

        if($this->year != null) {
            $this->merge([
                'year' => (integer) filter_var(trim($this->year), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->academic_program_id != null) {
            $this->merge([
                'academic_program_id' => (integer) filter_var($this->academic_program_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->user_id != null) {
            $this->merge([
                'user_id' => (integer) filter_var($this->user_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

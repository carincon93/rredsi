<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicProgramRequest extends FormRequest
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
            'name'             => 'required|string|max:191',
            'code'             => 'required|max:191',
            'academic_level'   => 'required|string|max:191',
            'modality'         => 'required|string|max:191',
            'daytime'          => 'required|string|max:191',
            'start_date'       => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'         => 'required|date|date_format:Y-m-d|after:start_date',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->name != null) {
            $this->merge([
                'name' => filter_var($this->name, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->code != null) {
            $this->merge([
                'code' => filter_var(trim($this->code), FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->academic_level != null) {
            $this->merge([
                'academic_level' => filter_var($this->academic_level, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->school != null) {
            $this->merge([
                'school' => filter_var($this->school, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->modality != null) {
            $this->merge([
                'modality' => filter_var($this->modality, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->daytime != null) {
            $this->merge([
                'daytime' => filter_var($this->daytime, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->start_date != null) {
            $this->merge([
                'start_date' => date("Y-m-d", strtotime($this->start_date)),
            ]);
        }

        if($this->end_date != null) {
            $this->merge([
                'end_date' => date("Y-m-d", strtotime($this->end_date)),
            ]);
        }
    }
}

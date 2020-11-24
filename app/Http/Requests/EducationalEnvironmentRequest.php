<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalEnvironmentRequest extends FormRequest
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
            'name'                          => 'required|string|max:191 ',
            'type'                          => 'required|string|max:191',
            'capacity_aprox'                => 'required|numeric|min:0|max:9999999999',
            'is_enabled'                    => 'required|boolean',
            'is_available'                  => 'required|boolean',
            'educational_institution_id'    => 'integer|min:0|max:9999999999',
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

        if($this->type != null) {
            $this->merge([
                'type' => filter_var($this->type, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->capacity_aprox != null) {
            $this->merge([
                'capacity_aprox' => (integer) filter_var(trim($this->capacity_aprox), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->is_enabled != null) {
            $this->merge([
                'is_enabled' => (boolean) $this->is_enabled,
            ]);
        }

        if($this->is_available != null) {
            $this->merge([
                'is_available' => (boolean) $this->is_available,
            ]);
        }

        if($this->educational_institution_id != null) {
            $this->merge([
                'educational_institution_id' => (integer) filter_var($this->educational_institution_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalToolRequest extends FormRequest
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
            'name'                          => 'required|string|max:191',
            'description'                   => 'required',
            'qty'                           => 'required|numeric|min:0|max:9999999999',
            'is_available'                  => 'required|boolean',
            'is_enabled'                    => 'required|boolean',
            'educational_environment_id'    => 'required|numeric|min:0|max:9999999999|exists:educational_environments,id',
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

        if($this->qty != null) {
            $this->merge([
                'qty' => (integer) filter_var(trim($this->qty), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->is_available != null) {
            $this->merge([
                'is_available' => (boolean) $this->is_available,
            ]);
        }

        if($this->is_enabled != null) {
            $this->merge([
                'is_enabled' => (boolean) $this->is_enabled,
            ]);
        }

        if($this->educational_environment_id != null) {
            $this->merge([
                'educational_environment_id' => (integer) filter_var($this->educational_environment_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

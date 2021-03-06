<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalInstitutionRequest extends FormRequest
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
        if ($this->isMethod('PUT')) {
            return [
                'name'              => 'required|string|max:191',
                'nit'               => 'required|string|max:191|unique:educational_institutions,nit,'.$this->route('educational_institution')->id.',id',
                'address'           => 'required|string|max:191',
                'city'              => 'required|string|max:191',
                'phone_number'      => 'integer|min:0|max:9999999999',
                'website'           => 'required|url|max:191',
            ];
        } else {
            return [
                'name'              => 'required|string|max:191',
                'nit'               => 'required|max:191|unique:educational_institutions,nit',
                'address'           => 'required|string|max:191',
                'city'              => 'required|string|max:191',
                'phone_number'      => 'integer|min:0|max:9999999999',
                'website'           => 'required|url|max:191',
            ];
        }
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

        if($this->nit != null) {
            $this->merge([
                'nit' => filter_var(trim($this->nit), FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->address != null) {
            $this->merge([
                'address' => filter_var($this->address, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->city != null) {
            $this->merge([
                'city' => filter_var($this->city, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->phone_number != null) {
            $this->merge([
                'phone_number' => (integer) filter_var(trim($this->phone_number), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->website != null) {
            $this->merge([
                'website' => filter_var(trim($this->website), FILTER_SANITIZE_URL),
            ]);
        }

        if($this->administrator_id != null) {
            $this->merge([
                'administrator_id' => (integer) filter_var($this->administrator_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->node_id != null) {
            $this->merge([
                'node_id' => (integer) filter_var($this->node_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

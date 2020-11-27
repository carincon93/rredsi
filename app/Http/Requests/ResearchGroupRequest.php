<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            if ($this->isMethod('PUT')){
            return [
                'name'                      => 'required|string|max:191',
                'email'                     => 'required|email|unique:research_groups,email,'.$this->route('research_group')->id.',id|max:191',
                'leader'                    => 'required|string|max:191',
                'gruplac'                   => 'url|max:191',
                'minciencias_code'          => 'required|string|max:191',
                'minciencias_category'      => 'required|max:1',
                'website'                   => 'url|max:191',
            ];
        } else {
            return [
                'name'                      => 'required|string|max:191',
                'email'                     => 'required|email|unique:research_groups,email|max:191',
                'leader'                    => 'required|string|max:191',
                'gruplac'                   => 'url|max:191',
                'minciencias_code'          => 'required|string|max:191',
                'minciencias_category'      => 'max:1',
                'website'                   => 'url|max:191',
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

        if($this->email != null) {
            $this->merge([
                'email' => filter_var(trim($this->email), FILTER_SANITIZE_EMAIL),
            ]);
        }

        if($this->leader != null) {
            $this->merge([
                'leader' => filter_var($this->leader, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->gruplac != null) {
            $this->merge([
                'gruplac' => filter_var(trim($this->gruplac), FILTER_SANITIZE_URL),
            ]);
        }

        if($this->minciencias_code != null) {
            $this->merge([
                'minciencias_code' => filter_var(trim($this->minciencias_code), FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->minciencias_category != null) {
            $this->merge([
                'minciencias_category' => filter_var($this->minciencias_category, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->website != null) {
            $this->merge([
                'website' => filter_var(trim($this->website), FILTER_SANITIZE_URL),
            ]);
        }

        if($this->educational_institution_id != null) {
            $this->merge([
                'educational_institution_id' => (integer) filter_var($this->educational_institution_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

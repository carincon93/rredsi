<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchOutputRequest extends FormRequest
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
            'title'             => 'required|string|max:191',
            'typology'          => 'required|string|max:191',
            'description'       => 'required',
            'file'              => 'file|max:20000',
            'project_id'        => 'required|numeric|min:0|max:9999999999|exists:projects,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->title != null) {
            $this->merge([
                'title' => filter_var($this->title, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->typology != null) {
            $this->merge([
                'typology' => filter_var($this->typology, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->project_id != null) {
            $this->merge([
                'project_id' => (integer) filter_var($this->project_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

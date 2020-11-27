<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchLineRequest extends FormRequest
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
            'name'              => 'required|string|max:191',
            'objectives'        => 'required',
            'mission'           => 'required',
            'vision'            => 'required',
            'achievements'      => 'required',
            'knowledge_area_id' => 'required|integer|min:0|max:9999999999|exists:knowledge_areas,id',
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
    }
}

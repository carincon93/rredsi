<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'location'                      => 'required|string|max:191',
            'description'                   => 'required',
            'start_date'                    => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'                      => 'required|date|date_format:Y-m-d|after:start_date',
            'link'                          => 'required|url|max:255',
            'educational_institution_id'    => 'integer|min:0|max:9999999999|exists:educational_institutions,id',
            'node_id'                       => 'integer|min:0|max:9999999999|exists:nodes,id',
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

        if($this->location != null) {
            $this->merge([
                'location' => filter_var($this->location, FILTER_SANITIZE_STRING),
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

        if($this->link != null) {
            $this->merge([
                'link' => filter_var(trim($this->link), FILTER_SANITIZE_URL),
            ]);
        }

        if($this->educational_institution_id != null) {
            $this->merge([
                'educational_institution_id' => (integer) filter_var($this->educational_institution_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->node_id != null) {
            $this->merge([
                'node_id' => (integer) filter_var($this->node_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

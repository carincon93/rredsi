<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'start_date'                    => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'                      => 'required|date|date_format:Y-m-d|after:start_date',
            'is_returned'                   => 'boolean',
            'is_accepted'                   => 'boolean',
            'justification'                 => 'required',
            'authorization_letter'          => 'required|file|max:20000',
            'project_id'                    => 'required|integer|min:0|max:9999999999|exists:projects,id',
            'educational_environment_id'    => 'integer|min:0|max:9999999999|exists:educational_environments,id',
            'educational_tool_id'           => 'integer|min:0|max:9999999999|exists:educational_tools,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
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

        // if($this->is_returned != null) {
        //     $this->merge([
        //         'is_returned' => (boolean) $this->is_returned,
        //     ]);
        // }

        // if($this->is_accepted != null) {
        //     $this->merge([
        //         'is_accepted' => (boolean) $this->is_accepted,
        //     ]);
        // }

        if($this->project_id != null) {
            $this->merge([
                'project_id' => (integer) filter_var($this->project_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->educational_environment_id != null) {
            $this->merge([
                'educational_environment_id' => (integer) filter_var($this->educational_environment_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->educational_tool_id != null) {
            $this->merge([
                'educational_tool_id' => (integer) filter_var($this->educational_tool_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

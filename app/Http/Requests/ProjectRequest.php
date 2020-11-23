<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title'             => 'required|string|max:255',
            'start_date'        => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'          => 'required|date|date_format:Y-m-d|after:start_date',
            'type'              => 'required|string|max:191',
            'abstract'          => 'required',
            'keywords'          => 'required|json',
            'file'              => 'required|file|max:20000',
            'overall_objective' => 'required',
            'is_privated'       => 'required|boolean',
            'is_published'      => 'required|boolean',
            'research_team_id'  => 'required|array',
            'research_line_id'  => 'required|array',
            'knowledge_area_id' => 'required|array',
            'academic_program_id' => 'required|array',
            'user_id'           => 'required|array'
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

        if($this->keywords != null) {
            $this->merge([
                'keywords' => json_encode(explode(',', $this->keywords, true)),
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

        if($this->type != null) {
            $this->merge([
                'type' => filter_var($this->type, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->is_privated != null) {
            $this->merge([
                'is_privated' => (boolean) $this->is_privated,
            ]);
        }

        if($this->is_published != null) {
            $this->merge([
                'is_published' => (boolean) $this->is_published,
            ]);
        }
    }
}

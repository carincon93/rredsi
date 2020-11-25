<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAcademicWorkRequest extends FormRequest
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
            'title'                     => 'required|string|max:191',
            'type'                      => 'required|string|max:191',
            'authors'                   => 'required|json',
            'grade'                     => 'required|between:0,99.99|max:9999999999',
            'mentors'                   => 'required|json',
            'research_group_id'         => 'required|numeric|min:0|max:9999999999|exists:research_groups,id',
            'knowledge_area_id'         => 'required|numeric|min:0|max:9999999999|exists:knowledge_areas,id',
            'graduation_id'             => 'required|numeric|min:0|max:9999999999|exists:graduations,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        #Use IF statement only if the input is required
        if($this->title != null) {
            $this->merge([
                'title' => filter_var($this->title, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->type != null) {
            $this->merge([
                'type' => filter_var($this->type, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->authors != null) {
            $this->merge([
                'authors' => json_encode(explode(',', $this->authors, true)),
            ]);
        }

        if($this->grade != null) {
            $this->merge([
                'grade' => (float) $this->grade,
            ]);
        }

        if($this->mentors != null) {
            $this->merge([
                'mentors' => json_encode(explode(',', $this->mentors, true)),
            ]);
        }

        if($this->research_group_id != null) {
            $this->merge([
                'research_group_id' => (integer) filter_var($this->research_group_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->knowledge_area_id != null) {
            $this->merge([
                'knowledge_area_id' => (integer) filter_var($this->knowledge_area_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->graduation_id != null) {
            $this->merge([
                'graduation_id' => (integer) filter_var($this->graduation_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

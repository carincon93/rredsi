<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchTeamRequest extends FormRequest
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
            'mentor_name'                   => 'required|string|max:191',
            'mentor_email'                  => 'required|email|max:191',
            'mentor_cellphone'              => 'required|numeric|min:0|max:9999999999',
            'overall_objective'             => 'required',
            'mission'                       => 'required',
            'vision'                        => 'required',
            'regional_projection'           => 'required',
            'knowledge_production_strategy' => 'required',
            'thematic_research'             => 'required|json',
            'administrator_id'              => 'required|numeric|min:0|max:9999999999|exists:research_team_admins,id',
            'research_group_id'             => 'required|numeric|min:0|max:9999999999|exists:research_groups,id',
            'student_leader_id'             => 'integer|min:0|max:9999999999|exists:students,id',            
            'research_line_id'              => 'required|array|exists:research_lines,id',
            'academic_program_id'           => 'required|array|exists:academic_programs,id',
            'knowledge_area_id'             => 'required|array|exists:knowledge_areas,id',
            'creation_date'                 => 'required|date|date_format:Y-m-d',
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

        if($this->mentor_name != null) {
            $this->merge([
                'mentor_name' => filter_var($this->mentor_name, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->mentor_email != null) {
            $this->merge([
                'mentor_email' => filter_var(trim($this->mentor_email), FILTER_SANITIZE_EMAIL),
            ]);
        }

        if($this->mentor_cellphone != null) {
            $this->merge([
                'mentor_cellphone' => (integer) filter_var(trim($this->mentor_cellphone), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->thematic_research != null) {
            $this->merge([
                'thematic_research' => json_encode(explode(',', $this->thematic_research, true)),
            ]);
        }

        if($this->administrator_id != null) {
            $this->merge([
                'administrator_id' => (integer) filter_var($this->administrator_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->research_group_id != null) {
            $this->merge([
                'research_group_id' => (integer) filter_var($this->research_group_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->student_leader_id != null) {
            $this->merge([
                'student_leader_id' => (integer) filter_var($this->student_leader_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->creation_date != null) {
            $this->merge([
                'creation_date' => date("Y-m-d", strtotime($this->creation_date)),
            ]);
        }
    }    
}

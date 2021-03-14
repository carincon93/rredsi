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
            'mentor_cellphone'              => 'required|integer|min:0|max:9999999999',
            'overall_objective'             => 'required',
            'mission'                       => 'required',
            'vision'                        => 'required',
            'regional_projection'           => 'required',
            'knowledge_production_strategy' => 'required',
            'thematic_research'             => 'required|json',
            'academic_program_id.*'         => 'required|integer|min:0|max:9999999999|exists:academic_programs,id',
            'knowledge_area_id.*'           => 'required|integer|min:0|max:9999999999|exists:knowledge_areas,id',
            'research_line_id.*'            => 'required|integer|min:0|max:9999999999|exists:research_lines,id',
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
        if($this->thematic_research != null) {
            $this->merge([
                'thematic_research' => json_encode(explode(',', $this->thematic_research), true),
            ]);
        }
    }
}

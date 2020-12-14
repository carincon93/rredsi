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
        if ($this->isMethod('PUT')){
            return [
                'main_image'            => 'mimes:jpeg,png,bmp,tiff |max:4096',
                'title'                 => 'required',
                'start_date'            => 'required|date|date_format:Y-m-d|before:end_date',
                'end_date'              => 'required|date|date_format:Y-m-d|after:start_date',
                'abstract'              => 'required',
                'keywords'              => 'required|json',
                'file'                  => 'max:20000|file|mimetypes:application/pdf',
                'overall_objective'     => 'required',
                'is_privated'           => 'required|boolean',
                'is_published'          => 'required|boolean',
                'project_type_id'       => 'required|min:0|max:9999999999|exists:project_types,id',
                'research_team_id.*'    => 'min:0|max:9999999999|exists:research_teams,id',
                'research_line_id.*'    => 'required|min:0|max:9999999999|exists:research_lines,id',
                'knowledge_area_id.*'   => 'required|min:0|max:9999999999|exists:knowledge_areas,id',
                'academic_program_id.*' => 'required|min:0|max:9999999999|exists:academic_programs,id',
                'user_id.*'             => 'required|min:0|max:9999999999|exists:users,id',
            ];
        } else {
            return [
                'main_image'            => 'mimes:jpeg,png,bmp,tiff|max:4096',
                'title'                 => 'required',
                'start_date'            => 'required|date|date_format:Y-m-d|before:end_date',
                'end_date'              => 'required|date|date_format:Y-m-d|after:start_date',
                'abstract'              => 'required',
                'keywords'              => 'required|json',
                'file'                  => 'file|max:20000|mimetypes:application/pdf',
                'overall_objective'     => 'required',
                'is_privated'           => 'required|boolean',
                'is_published'          => 'required|boolean',
                'project_type_id'       => 'required|min:0|max:9999999999|exists:project_types,id',
                'research_team_id.*'    => 'min:0|max:9999999999|exists:research_teams,id',
                'research_line_id.*'    => 'required|min:0|max:9999999999|exists:research_lines,id',
                'knowledge_area_id.*'   => 'required|min:0|max:9999999999|exists:knowledge_areas,id',
                'academic_program_id.*' => 'required|min:0|max:9999999999|exists:academic_programs,id',
                'user_id.*'             => 'required|min:0|max:9999999999|exists:users,id',
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
        if($this->keywords != null) {
            $this->merge([
                'keywords' => json_encode(explode(',', $this->keywords, true)),
            ]);
        }

        if($this->roles_requirements != null) {
            $this->merge([
                'roles_requirements' => json_encode(explode(',', $this->roles_requirements, true)),
            ]);
        }

        if($this->tools_requirements != null) {
            $this->merge([
                'tools_requirements' => json_encode(explode(',', $this->tools_requirements, true)),
            ]);
        }
    }
}

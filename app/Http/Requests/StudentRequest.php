<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
                'name'                  => 'required|string|max:191',
                'email'                 => 'required|string|max:191|email|unique:users,email,'.$this->route('student')->id.',id',
                'document_type'         => 'required|string| max:2',
                'document_number'       => 'required|integer|min:0|max:9999999999|unique:users,document_number,'.$this->route('student')->id.',id',
                'cellphone_number'      => 'required|integer|min:0|max:9999999999',
                'status'                => 'required|string|max:191',
                'interests'             => 'required|json',
                'is_enabled'            => 'required|boolean',
                'role_id'               => 'required|integer|min:0|max:9999999999',
                'research_team_id'      => 'required|array|exists:research_teams,id',
                'is_external'           => 'required|boolean',
                'academic_program_id'   => 'required|array|exists:academic_programs,id',
                'cvlac'                 => 'required|url|max:191',
                'is_accepted'           => 'required|boolean',
            ];
        } else {
            return [
                'name'                  => 'required|string|max:191',
                'email'                 => 'required|string|max:191|email|unique:users,email',
                'document_type'         => 'required|string| max:2',
                'document_number'       => 'required|integer|min:0|max:9999999999|unique:users,document_number',
                'cellphone_number'      => 'required|integer|min:0|max:9999999999',
                'status'                => 'required|string|max:191',
                'interests'             => 'required|json',
                'is_enabled'            => 'required|boolean',
                'role_id'               => 'required|integer|min:0|max:9999999999',
                'research_team_id'      => 'required|array|exists:research_teams,id',
                'is_external'           => 'required|boolean',
                'academic_program_id'   => 'required|array|exists:academic_programs,id',
                'cvlac'                 => 'required|url|max:191',
                'is_accepted'           => 'required|boolean',
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

        if($this->document_type != null) {
            $this->merge([
                'document_type' => filter_var($this->document_type, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->document_number != null) {
            $this->merge([
                'document_number' => filter_var(trim($this->document_number), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->cellphone_number != null) {
            $this->merge([
                'cellphone_number' => filter_var(trim($this->cellphone_number), FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->status != null) {
            $this->merge([
                'status' => filter_var($this->status, FILTER_SANITIZE_STRING),
            ]);
        }

        if($this->interests != null) {
            $this->merge([
                'interests' => json_encode(explode(',', $this->interests, true)),
            ]);
        }

        if($this->is_enabled != null) {
            $this->merge([
                'is_enabled' => (boolean) $this->is_enabled,
            ]);
        }

        if($this->role_id != null) {
            $this->merge([
                'role_id' => filter_var($this->role_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }

        if($this->cvlac != null) {
            $this->merge([
                'cvlac' => filter_var($this->cvlac, FILTER_SANITIZE_URL),
            ]);
        }

        if($this->is_accepted != null) {
            $this->merge([
                'is_accepted' => (boolean) $this->is_accepted,
            ]);
        }
    }
}

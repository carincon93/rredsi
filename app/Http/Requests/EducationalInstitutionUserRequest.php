<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationalInstitutionUserRequest extends FormRequest
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
        if($this->isMethod('PUT')){
        return [
            'name'              => 'required|string|max:191',
            'email'             => 'required|string|max:191|email|unique:users,email,'.$this->route('user')->id.',id',
            'document_type'     => 'required|string| max:2',
            'document_number'   => 'required|integer|min:0|max:9999999999|unique:users,document_number,'.$this->route('user')->id.',id',
            'cellphone_number'  => 'required|integer|min:0|max:9999999999',
            'interests'         => 'required|json',
            'is_enabled'        => 'required|boolean',
            'role_id.*'         => 'required|min:0|max:9999999999|exists:roles,id',
        ];
    } else {
        return [
            'name'              => 'required|string|max:191',
            'email'             => 'required|string|max:191|email|unique:users,email',
            'document_type'     => 'required|string| max:2',
            'document_number'   => 'required|integer|min:0|max:9999999999|unique:users,document_number',
            'cellphone_number'  => 'required|integer|min:0|max:9999999999',
            'interests'         => 'required|json',
            'is_enabled'        => 'required|boolean',
            'role_id.*'         => 'required|min:0|max:9999999999|exists:roles,id',
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
        if($this->interests != null) {
            $this->merge([
                'interests' => json_encode(explode(',', $this->interests), true),
            ]);
        }
    }
}

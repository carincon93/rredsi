<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessIdeasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            'name'              => 'required|string|max:191|min:5',
            'description'       => 'required|string|max:5000|min:5',
            'type'              => 'required|string|max:191',
            'have_tools'        => 'boolean',
            'tools'             => 'string|max:191|min:5',
            'have_money'        => 'boolean',
            'money'             => 'integer|min:0|max:9999999999',
            'condition'         => 'required|string|max:191',
        ];
    } else {
        return [
            'name'              => 'required|string|max:191|min:5',
            'description'       => 'required|string|max:5000|min:5',
            'type'              => 'required|string|max:191',
            'have_tools'        => 'boolean',
            'tools'             => 'string|max:191|min:5',
            'have_money'        => 'boolean',
            'money'             => 'integer|min:0|max:9999999999',
            'condition'         => 'required|string|max:191',
        ];
    }
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
}

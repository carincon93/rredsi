<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
            'name'              => 'required|string|max:191',
            'nit'               => 'required|string|max:191',
            'email'             => 'required|string|max:191|email',
            'cellphone_number'  => 'required|integer|min:0|max:9999999999',
            'data_authorization'        => 'boolean',
            'address'              => 'required|string|max:191',
        ];
    } else {
        return [
            'name'              => 'required|string|max:191',
            'nit'               => 'required|string|max:191',
            'email'             => 'required|string|max:191|email',
            'cellphone_number'  => 'required|integer|min:0|max:9999999999',
            'data_authorization'        => 'boolean',
            'address'              => 'required|string|max:191',
        ];
    }
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
}

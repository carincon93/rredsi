<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNodeRequest extends FormRequest
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
            'state'             => 'required|string|unique:nodes,state|max:191',
            'administrator_id'  => 'required|numeric|min:0|max:9999999999',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->state != null) {
            $this->merge([
                'state' => filter_var($this->state, FILTER_SANITIZE_STRING),
            ]);
        }
   
        if($this->administrator_id != null) {
            $this->merge([
                'administrator_id' => (integer) filter_var($this->administrator_id, FILTER_SANITIZE_NUMBER_INT),
            ]);
        }
    }
}

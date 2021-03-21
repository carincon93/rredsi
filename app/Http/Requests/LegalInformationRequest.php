<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LegalInformationRequest extends FormRequest
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
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:999999',
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
    }
}

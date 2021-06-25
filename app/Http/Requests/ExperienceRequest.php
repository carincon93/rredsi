<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'Title'                 => 'required|string|max:191|min:5',
            'Description'           => 'required|string|max:191|min:10',
            'Image'                 => 'mimes:jpeg,png|max:1024',

            
        ];
    } else {
        return [
            'Title'                 => 'required|string|max:191|min:5',
            'Description'           => 'required|string|max:191|min:10',
            'Image'                 => 'mimes:jpeg,png|max:1024',
        ];
    }
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
}

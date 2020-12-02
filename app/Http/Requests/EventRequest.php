<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'location'                      => 'required|string|max:191',
            'description'                   => 'required',
            'start_date'                    => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'                      => 'required|date|date_format:Y-m-d|after:start_date',
            'link'                          => 'required|url|max:255',
            // 'educational_institution_id'    => 'integer|min:0|max:9999999999|exists:educational_institutions,id',
            // 'node_id'                       => 'integer|min:0|max:9999999999|exists:nodes,id',
        ];
    }
}

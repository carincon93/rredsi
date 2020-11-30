<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAcademicWorkRequest extends FormRequest
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
            'title'                     => 'required|string|max:191',
            'type'                      => 'required|string|max:191',
            'authors'                   => 'required|json',
            'grade'                     => 'required|between:0,99.99|max:9999999999',
            'mentors'                   => 'required|json',
            'knowledge_area_id'         => 'required|integer|min:0|max:9999999999|exists:knowledge_areas,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->authors != null) {
            $this->merge([
                'authors' => json_encode(explode(',', $this->authors, true)),
            ]);
        }

        if ($this->mentors != null) {
            $this->merge([
                'mentors' => json_encode(explode(',', $this->mentors, true)),
            ]);
        }
    }
}

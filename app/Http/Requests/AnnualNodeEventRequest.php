<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AnnualNodeEventRequest extends FormRequest
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
            'presentation_type'     => 'required|string|max:191',
            'project_status'        => 'required|string|max:191',
            'project_id'            => 'required',
            'first_speaker_id'      => 'required',
            'second_speaker_id'     => 'required',
            'knowledge_area_id.*'   => 'required',
            'research_team_id'      => 'required',
            'academic_program_id'   => 'required',
            'endorsement_letter'    => 'required|file|mimetypes:application/pdf|max:512000',
            'project_article'       => 'required|file|mimetypes:application/pdf|max:512000',
        ];
    }

    public function response(array $errors)
    {
        if ($this->forceJsonResponse || $this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}

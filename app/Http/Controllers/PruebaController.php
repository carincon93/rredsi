<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;


class PruebaController extends Controller
{

    public function exportWord(Request $request)
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path("/storage/templates/plantilla.docx"));

        // $project = Project::with('node', 'educationalInstitution', 'researchGroup','ResearchTeam')->findOrFail($request->get('project_id'));

        $project = Project::find($request->get('project_id'));

        $nameWord = explode(" ",$project->title);

        $templateProcessor->setValue('title',$project->title);

        $templateProcessor->saveAs($nameWord[0] . ".docx");
        return response()->download($nameWord[0] . ".docx")->deleteFileAfterSend(true);

    }
}

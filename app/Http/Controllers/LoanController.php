<?php

namespace App\Http\Controllers;

use App\EducationalEnvironment;
use App\EducationalEnvironmentLoan;
use App\EducationalTool;
use App\EducationalToolLoan;
use App\Loan;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Loan::all();
    }

    public function indexEnvironmentLoanRequest()
    {
        return EducationalEnvironmentLoan::with('loan', 'educationalEnvironment', 'educationalEnvironment.educationalInstitution')->get();
    }
    public function showEnvironmentLoanRequest($id)
    {
        return EducationalEnvironmentLoan::with('loan', 'loan.project', 'loan.project.authors', 'loan.project.researchTeams', 'loan.project.researchTeams.studentLeader.user', 'educationalEnvironment')->find($id);
    }

    public function indexToolLoanRequest()
    {
        return EducationalToolLoan::with('loan', 'educationalTool.educationalEnvironment.educationalInstitution')->get();
    }

    public function showToolLoanRequest($id)
    {
        return EducationalToolLoan::with('loan.project.authors','loan.project.researchTeams.studentLeader', 'educationalTool.educationalEnvironment.educationalInstitution')->find($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $loan = new Loan();
        $loan->start_date           = $request->get('start_date');
        $loan->end_date             = $request->get('end_date');
        $loan->is_returned          = $request->get('is_returned');
        $loan->is_accepted          = $request->get('is_accepted');
        $loan->justification        = $request->get('justification');
        if ($request->hasFile('authorization_letter')) {
            $file = $request->file('authorization_letter');
            $fileName = $file->getClientOriginalName();
            Storage::putFileAs(
                'public/loan-authorization-letters', $file, $fileName
            );

            $loan->authorization_letter  = "loan-authorization-letters/$fileName";
        }
        $loan->annotation           = $request->get('annotation');
        $loan->project()->associate($request->get('project_id'));
        $loan->save();

        if($request->get('educational_environment_id')) {
            $loan->educationalEnvironmentLoan()->create([
                'id'                            => $loan->id, 
                'educational_environment_id'    => $request->get('educational_environment_id')
            ]);
        } elseif($request->get('educational_tool_id')) {
            $loan->educationalToolLoan()->create([
                'id'                            => $loan->id,
                'educational_tool_id'           => $request->get('educational_tool_id')
            ]);
        }else{
            return response()->json([
                'educational_tool_id' => $request->get('educational_tool_id'),
                'educational_environment_id' => $request->get('educational_environment_id'),
            ]);
        }

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your store processed correctly'
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return response()->json($loan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        return response()->json($loan);
    }

    public function check(Request $request, Loan $loan)
    {
        $validator = Validator::make($request->all(), [
            'is_accepted'=>['required', 'bool'],
            'annotation'=>['required', 'string']
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $loan->is_accepted = $request->get('is_accepted');
        $loan->annotation = $request->get('annotation');
        $loan->save();
        return response()->json([
            'success'=>true,
            'status'=>200,
            'message'=>'Your update processed correctly'
        ]);
    }

    public function return(Request $request, Loan $loan)
    {
        $loan->returned_at = new DateTime();
        $loan->is_returned = true;
        $loan->save();
        return response()->json([
            'success'=>true,
            'status'=>200,
            'message'=>'Your update processed correctly'
        ]);
    }

    public function returnCheck(Request $request, Loan $loan)
    {
        $is_accepted = $request->get('is_accepted');
        if($is_accepted==1){
            $loan->accepted_at = new DateTime();
            $loan->annotation = $request->get('annotation');
            $loan->save();
            return response()->json([
                'success'=>true,
                'status'=>200,
                'message'=>'Your update processed correctly'
            ]);
        }else{
            $loan->annotation = $request->get('annotation');
            $loan->save();
            return response()->json([
                'success'=>true,
                'status'=>200,
                'message'=>'Your update processed correctly'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(LoanRequest $request, Loan $loan)
    {
        $loan->start_date           = $request->get('start_date');
        $loan->end_date             = $request->get('end_date');
        $loan->is_returned          = $request->get('is_returned');
        $loan->is_accepted          = $request->get('is_accepted');
        $loan->justification        = $request->get('justification');
        if ($request->hasFile('authorization_letter')) {
            $path  = Storage::putFile(
                'public/loan-authorization-letters', $request->file('authorization_letter')
            );

            $loan->authorization_letter = $path;
        }
        $loan->annotation           = $request->get('annotation');
        $loan->project()->associate($request->get('project_id'));

        if($request->get('educational_environment_id')) {
            $loan->educationalEnvironmentLoan()->update([
                'educational_environment_id'    => $request->get('educational_environment_id')
            ]);
        } elseif($request->get('educational_tool_id')) {
            $loan->educationalToolLoan()->update([
                'educational_tool_id'    => $request->get('educational_tool_id')
            ]);
        }

        $loan->save();

        $data = [
            'success'   => true,
            'status'    => 200,
            'message'   => 'Your update processed correctly'
        ];

        return response()->json($data);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        try
        {
            if($loan->delete()){
                return 'Eliminado';
            }
        }
        catch(Exception $e) {
            //Log::error($e->getMessage());
            if($e->getCode()==23000) {
                return 'Error 23000';
            }
        }
    }
}

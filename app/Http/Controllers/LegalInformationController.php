<?php

namespace App\Http\Controllers;

use App\Models\legalInformation;
use App\Http\Requests\LegalInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LegalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [LegalInformation::class]);

        $legalInformations = legalInformation::orderBy('title')->get();

        return view('LegalInformations.index', compact('legalInformations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [LegalInformation::class]);

        return view('LegalInformations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LegalInformationRequest $request)
    {
        $this->authorize('create', [LegalInformation::class]);

        $legalInformation               = new legalInformation();
        $legalInformation->title        = $request->get('title');
        $legalInformation->slug         = Str::slug($request->get('title'));
        $legalInformation->description  = $request->get('description');

        if($legalInformation->save()){
            $message = 'Your store processed correctly';
        }

        return redirect()->route('legal-informations.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\legal_information  $legal_information
     * @return \Illuminate\Http\Response
     */
    public function show(LegalInformation $legalInformation)
    {
        $this->authorize('view', [LegalInformation::class]);

        return view('LegalInformations.show', compact('legalInformation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\legal_information  $legal_information
     * @return \Illuminate\Http\Response
     */
    public function edit(LegalInformation $legalInformation)
    {
        $this->authorize('update',[ legalInformation::class]);

        return view('LegalInformations.edit', compact('legalInformation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\legal_information  $legal_information
     * @return \Illuminate\Http\Response
     */
    public function update(LegalInformationRequest $request, LegalInformation $legalInformation)
    {
        $this->authorize('update', [LegalInformation::class]);

        $legalInformation->title        = $request->get('title');
        $legalInformation->slug         = Str::slug($request->get('title'));
        $legalInformation->description  = $request->get('description');

        if($legalInformation->save()){
            $message = 'Your update processed correctly';
        }

        return redirect()->route('legal-informations.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\legal_information  $legal_information
     * @return \Illuminate\Http\Response
     */
    public function destroy(LegalInformation $legalInformation)
    {
        $this->authorize('delete', [LegalInformation::class]);

        if($legalInformation->delete()){
            $message = 'Your delete processed correctly';
        }
        return redirect()->route('legal-informations.index')->with('status', $message);
    }

    /**
     * showLegalInformation
     *
     * @return void
     */
    public function showLegalInformation($slug)
    {
        $legalInformation = LegalInformation::where('slug', Str::slug($slug))->firstOrFail();

        $legalInformations = legalInformation::orderBy('title')->get();

        return view('Explorer.show-legal-information', compact('legalInformation', 'legalInformations'));
    }
}

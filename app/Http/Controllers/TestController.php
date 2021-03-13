<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [Test::class]);

        $tests = Test::orderBy('name', 'ASC')->paginate(100);

        return view('Tests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [Test::class]);

        return view('resourceRoute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $this->authorize('create', [Test::class]);

        $test = new Test();
        $test->fieldName = $request->get('fieldName');
        $test->fieldName = $request->get('fieldName');
        $test->fieldName = $request->get('fieldName');

        if ( !$test->save() ) {
            return redirect()->route('resourceRoute.create')->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('resourceRoute.index')->with('status', __('The resource has been created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $this->authorize('view', [Test::class, $test]);

        return view('resourceRoute.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $this->authorize('update', [Test::class, $test]);

        return view('resourceRoute.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, Test $test)
    {
        $this->authorize('update', [Test::class, $test]);

        $test->fieldName = $request->get('fieldName');
        $test->fieldName = $request->get('fieldName');
        $test->fieldName = $request->get('fieldName');

        if ( !$test->save() ) {
            return redirect()->route('resourceRoute.edit', [$test])->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('resourceRoute.index')->with('status', __('The resource has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $this->authorize('delete', [Test::class, $test]);

         if ( !$test->delete() ) {
            return redirect()->route('resourceRoute.edit', [$test])->withInput()->with('status', __('An error has ocurred. Please try again later.'));
        }

        return redirect()->route('resourceRoute.index')->with('status', __('The resource has been deleted successfully.'));
    }
}

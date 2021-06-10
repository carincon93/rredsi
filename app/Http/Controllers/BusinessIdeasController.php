<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\Businessideas;



class BusinessIdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user       = auth()->user();
        $business_ideas      = BusinessIdeas::All();
        $business            = Business::All();

        return view('BusinessIdeas.index', compact('business_ideas','business'));
    }
}

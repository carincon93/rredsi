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
        $user                = auth()->user();
        $business_ideas      = BusinessIdeas::Paginate(10);
        $business            = Business::All();

        return view('BusinessIdeas.index', compact('business_ideas','business'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user                = auth()->user();
        $user->business()->get();
        $user_business = $user->business()->first();

        return view('BusinessIdeas.create', compact('user_business'));
    }



}

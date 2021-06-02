<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\User;

use Illuminate\Http\Request;

class BusinessIdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BusinessIdeas.index');
    }
}

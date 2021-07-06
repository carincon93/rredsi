<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProvidersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SearchProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user = auth()->user();
        $business = $user->business()->first();
        $product = new Product();
        $this->authorize('viewAny',[Product::class, $product]); 
        $datos['products'] = DB::table('products')
        ->join('businesses', 'businesses.id', '=', 'products.id_business')
        ->select('products.*', 'businesses.name', 'businesses.cellphone_number', 'businesses.email', 'businesses.address')
        ->paginate(10);
        return view('searchproviders.index',$datos);      
    }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SearchProviders  $searchProviders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $business = $user->business()->first();
        $product=Product::findOrFail($id);
        $this->authorize('view',[Product::class, $product]); 
        $business = Business::where('businesses.id','=', $product->id_business)->first();
        return view('searchproviders.show', compact('product','business'));
    }

}

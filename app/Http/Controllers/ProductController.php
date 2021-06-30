<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
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


        $datos['products'] = DB::table('products')
        ->join('businesses', 'businesses.id', '=', 'products.id_business')
        ->select('products.*', 'businesses.name', 'businesses.cellphone_number', 'businesses.email', 'businesses.address')
        ->where('products.id_business', '=', $business->id)
        ->paginate(10);
        
        return view('Products.index',$datos, compact('business'));

    
        // $datos['products']=Product::paginate(10);

        // $user = auth()->user();
        // $business = $user->business()->first();
        // return view('Products.index',$datos, compact('business'));
        //    
    }

    
      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $product=Product::findOrFail($id);
        return view('products.show', compact('product', ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Products.create');

        $user = auth()->user();
        $business = $user->business()->first();
        return view('Products.create',compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->Nombre                            = $request->get('Nombre');
        $product->Descripcion                       = $request->get('Descripcion');
        $product->id_business                       = $request->get('id_business');

        $file = $request->get('Foto');

        if ($request->hasFile('Foto')){

            $file=$request->file('Foto')->store('product-images','public');
            $product->Foto = $file;
        }

        
      
        if($product->save()){ 

            return redirect()->back()->with('mensaje','Producto agregado con exito'); 
        }else{

            return redirect()->back()->with('mensaje','Hubo un error al agregar el producto');
        }

    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $business = $user->business()->first();
        $product=Product::findOrFail($id);
        return view('products.edit', compact('product', 'business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        $product->Nombre                            = $request->get('Nombre');
        $product->Descripcion                       = $request->get('Descripcion');
        
        $file = $request->get('Foto');

        if ($request->hasFile('Foto')){
            Storage::delete("public/$product->Foto");
            $file=$request->file('Foto')->store('product-images','public');
            $product->Foto = $file;
        }

        



        if($product->save()){ 


            return redirect()->back()->with('mensaje','Producto editado con éxito'); 
        }else{

            return redirect()->back()->with('mensaje','Hubo un error al editar el producto');
        }

       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product=Product::findOrFail($id);

        Storage::delete('public/'.$product->Foto);

        Product::destroy($id);

        return redirect('products')->with('mensaje','Producto borrado con éxito');
    }
}

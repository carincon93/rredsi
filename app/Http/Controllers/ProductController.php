<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Business;
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
        $product = new Product();
        $this->authorize('viewAny',[Product::class, $product]); 
        $products = Product::where('id_business', '=', $business->id)->paginate(10);        
        return view('Products.index', compact('business', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
        $user = auth()->user();
        $business = $user->business()->first();     
        //error_log('aqui llego 1 ');
        $this->authorize('update', [Product::class, $product]);      
        return view('products.edit', compact('product', 'business'));
    }

    
      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = auth()->user();
        $business = $user->business()->first();
        $this->authorize('view', [Product::class, $product]);  
        //$product=Product::findOrFail($product->id);
        return view('products.show', compact('product', ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $user = auth()->user();
        $business = $user->business()->first();
        $this->authorize('delete', [Product::class, $product]);
        Storage::delete('public/'.$product->Foto);
        Product::destroy($product->id);
        $mensaje= 'Producto borrado con éxito';
        
        return redirect('/products')->with('mensaje','Producto borrado con éxito');      
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {       
        $user = auth()->user();
        $business = $user->business()->first(); 
        $product = new Product();
        $product->Nombre                            = $request->get('Nombre');
        $product->Descripcion                       = $request->get('Descripcion');
        $product->id_business                       = $request->get('id_business');
        $this->authorize('create', [Product::class, $product]); 
        $file = $request->get('Foto');
        if ($request->hasFile('Foto')){
            $file=$request->file('Foto')->store('product-images','public');
            $product->Foto = $file;
        }  
        if($product->save()){ 
            return redirect()->back()->with('mensaje','Producto creado con exito'); 
        }else{
            return redirect()->back()->with('mensaje','Hubo un error almacenando el producto');
        }

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
    
}

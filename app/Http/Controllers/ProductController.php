<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datos['products']=Product::paginate(10);
        return view('Products.index',$datos);
    }

    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
            'Foto'=>'max:10000|mimes:jpg,png,',
        ];

        $mensaje=[
            'Descripcion.required'=>'La Descripción es requerida',
            'Nombre.required'=>'El nombre es requerido'
            
        ];

        $this->validate($request, $campos, $mensaje);


        $datosProduct = request()->except('_token');

        if ($request->hasFile('Foto')){
            $datosProduct['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Product::insert($datosProduct);
        //return response()->json($datosProduct);

        return redirect('products/create')->with('mensaje','Producto agregado con éxito');



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
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
            'Foto'=>'max:10000|mimes:jpg,png,',
        ];

        $mensaje=[
            'Descripcion.required'=>'La Descripción es requerida',
            'Nombre.required'=>'El nombre es requerido'
            
        ];

        $this->validate($request, $campos, $mensaje);
        
        $datosProduct = request()->except('_token','_method');

        if ($request->hasFile('Foto')){
            $product=Product::findOrFail($id);
            Storage::delete('public/'.$product->Foto);
            $datosProduct['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Product::where('id','=',$id)->update($datosProduct);

        $product=Product::findOrFail($id);
        // return view('products.edit', compact('product'));


        return redirect('products')->with('mensaje','Producto editado con éxito');
       
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

        if(Storage::delete('public/'.$product->Foto)){
            Product::destroy($id);

        }

        
       return redirect('products')->with('mensaje','Producto borrado con éxito');
    }
}

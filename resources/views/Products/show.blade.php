<title>{{'Mis productos y servicios'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Mis productos y servicios') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                Mostrar productos y servicios
                </span>
            </h2>
        </div>
        
    </x-slot>
    

    
    <div class=" content-center">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
              <div class="grid grid-cols-2 ">
              <div class="flex-auto w-full mb-1 text-xs space-y-2">
                <label for="Nombre" class="sm:not-sr-only block text-sm font-medium text-gray-700">
                  Nombre
                </label>
                <div class=" h-8 mt-1 flex rounded-md shadow-sm">
                  <input readonly="readonly" class=" cursor-default  appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4" placeholder="Nombre del producto" name="Nombre" value="{{ isset($product->Nombre)?$product->Nombre:old('Nombre') }}" id="Nombre">
                </div>
              </div>
            </div>
            </div>
        </div>
        

            <div>
              <label class="block text-sm font-medium text-gray-700">
                Foto
              </label>

              <div class="flex space-x-3 justifycontent-center" >

  <div class="mt-1 w-40   flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border rounded-md">

    <p class="text-xs text-gray-500 ">

    @if(isset($product->Foto))
          

          
          <div>
              <img  src="{{asset('storage').'/'.$product->Foto}}">
          </div>

          @else 

         
        
              <div class="m-auto">
                <div class="text-center text-xs text-gray-500 flex-auto w-full mb-1 space-y-2 ">
                    <span class="inline-block align-text-bottom ...">No hay foto</span>
                </div>
              </div>
        
          
          

          @endif

          <br>
         
      
    </p>
  
</div>
</div>
</div>

          



              <div class="grid grid-cols-2 ">
              
                <div class="flex-auto w-full mb-1 text-xs space-y-2">
									<label for="Descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>

                  <div class="  mt-1 flex rounded-md shadow-sm">

                  <Textarea readonly="readonly"   class=" cursor-default text-justify w-full min-h-[100px] max-h-[300px] h-20 appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4" placeholder="Descripción del producto" name="Descripcion" id="Descripcion" >{{ isset($product->Descripcion)?$product->Descripcion:old('Descripcion') }}</Textarea>

								</div>
                
                </div>
              </div>
            </div>
            

  <br>


<div class="flex space-x-1 justify-center content-center">
                <a href="{{url('products/')}}">
                    <div class=" w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    <div class="flex justify-center content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="transform transition-transform duration-500 ease-in-out" width="24" height="15" fill="currentColor" viewBox="0 -2 24 24" stroke="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>                        
                            <div>Volver</div>
                        </div> 
                    </div>
                    </a>


                <a href="{{url('/products/'.$product->id.'/edit')}}">
                <div class=" w-auto text-center text-base sm:w-auto items-center justify-center text-blue-400 group-hover:text-blue-300 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">   
                    <div class="flex  justify-center content-center">
                        <div>Editar</div>
                    </div>    
                </div>                            
                </a>

                <form action="{{url('/products/'.$product->id)}}" method="post" >
                        @csrf
                        {{method_field('DELETE')}}

                            <a>
                            <div class=" w-auto text-center text-base sm:w-auto items-center justify-center text-blue-400 group-hover:text-blue-300 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">   
                                <div class="flex justify-center content-center">
                                   
                                    <input type="submit" onclick="return confirm('¿Desea eliminar este producto o servicio?')" value="Borrar" >
                                </div>    
                            </div>
                           </a>                            
                    </form>
   
</div>



</x-app-layout>
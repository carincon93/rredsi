<title>{{'Mis productos y servicios'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Mis productos y servicios') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                {{$modo}} producto o servicio
                </span>
            </h2>
        </div>
        
    </x-slot>
    
    

    
    <div class="content-center">
    <div class="max-w-7 mx-auto sm:px-6 lg:px-8 ">

    @if(Session::has('mensaje'))
    <div x-data="{ show: true }" x-show="show" class="container" id="alertbox">
        <div class="container flex items-center text-sm px-4 py-3 relative bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				<path
					d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
			</svg>

        <p class="font-bold">{{Session::get('mensaje')}}</p>
        
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 closealertbutton">
            <button type="button"  @click="show = false"  >
            <svg class="fill-current h-6 w-6 text-blue" role="button" xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 20 20">
					<title>Close</title>
					<path
						d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
				</svg>
            </button>

            </span>
        </div>
    </div>
    @endif
    <br>

    

@if(count($errors)>0)
    @foreach($errors->all() as $error)
    <div x-data="{ show: true }" x-show="show" class="container" id="alertbox">
        <div class="container   flex items-center text-sm px-4 py-3 relative bg-red-100 border-t border-b border-red-500 text-red-700" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				<path
					d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
			</svg>

        <p class="font-bold">{{$error}}</p>
        
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 closealertbutton">
            <button type="button"  @click="show = false"  >
            <svg class="fill-current h-6 w-6 text-blue" role="button" xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 20 20">
					<title>Close</title>
					<path
						d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
				</svg>
            </button>

            </span>
        </div>
    </div>
    <br>

    @endforeach
    @endif

    
    <br>
    <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <div class="grid grid-cols-2">


          <input type="hidden"  value="{{ $business->id }}" name="id_business" id="id_business">
            
              <div class="flex-auto w-full mb-1 text-xs space-y-2">
                <label for="Nombre" class="block text-sm font-medium text-gray-700">
                  Nombre
                </label>
                <div class="h-8 mt-1 flex rounded-md shadow-sm">
                  
                  <input  class=" appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4" placeholder="Nombre del producto" name="Nombre" value="{{ isset($product->Nombre)?$product->Nombre:old('Nombre') }}" data-error="" minlength="5" id="Nombre">
                </div>
              </div>
              </div>
            
                      
              <div class="col-span-3 sm:col-span-2">
              <div class="grid grid-cols-2 ">
                <div class="flex-auto w-full mb-1 text-xs space-y-2">
									<label for="Descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>

                  <div class="  mt-1 flex rounded-md shadow-sm">

                  <Textarea class=" text-justify w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4" placeholder="Descripción del producto" name="Descripcion" data-error="" minlength="10" id="Descripcion" >{{isset($product->Descripcion)?$product->Descripcion:old('Descripcion')}}</Textarea>

								</div>
              </div>
            </div>
            </div>



 
            <div>
              <label class="block text-sm font-medium text-gray-700">
                Foto
              </label>
  
              
      
                  @if(isset($product->Foto))
           
                  <div class="flex space-x-3 justifycontent-center" >
              <div class="mt-1 w-40  flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border rounded-md">
                  <p class="text-xs text-gray-500 ">  
                        <div class="m-auto">
                            <div  class="text-center text-xs text-gray-500 flex-auto w-full mb-1 space-y-2 ">
                              <img  src="{{asset('storage').'/'.$product->Foto}}">
                              <span class=" inline-block align-text-bottom ...">Foto actual</span>
                            </div>
                        </div>
                  </p>
              </div>
              

              <br>
              <div class=" mt-1 space-x-2   w-120 flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border-dashed rounded-md">
             
              <div class="mt-1 w-40   flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border rounded-md">
                  <p class="text-xs text-gray-500 ">  
                        <div class="m-auto">
                              <div  class="text-center text-xs text-gray-500 flex-auto w-full mb-1 space-y-2 ">
                                  <img id="preimage">
                                  <span class=" inline-block align-text-bottom ...">Previsualización de nueva foto</span>
                              </div>
                        </div>
                        </div>

                        @else 


                        <div class="flex space-x-3 justifycontent-center" >
             
      <div class="space-x-2 mt-1 w-100 flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border-dashed rounded-md">
             <div class="mt-1 w-40   flex justify-center px-3 pt-3 pb-3 border-2 border-gray-300 border rounded-md">
                  <p class="text-xs text-gray-500 ">  
                        <div class="m-auto">
                              <div  class="text-center text-xs text-gray-500 flex-auto w-full mb-1 space-y-2 ">
                                  <img id="preimage">
                                  <span class=" inline-block align-text-bottom ...">Previsualización</span>
                              </div>
                        </div>
                        </div>
                        @endif
                        <br>        
                  </p>
              
            
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="Foto" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                      <span >Cargar archivo</span>  

                      <input id="Foto" name="Foto" type="file" class="sr-only" accept=".jpg,.png" onchange="loadfile(event)">                      
                     
                    </label>
                  </div>
                  <p class="text-xs text-gray-500">
                    PNG, JPG, Max 1MB
                  </p>
                </div>
              </div>
            </div>
          </div>
         </div>
         
        
         
         
         


          <div class="flex justify-center content-center">
    <table class="table-fixed">
        <tbody>
            <tr>
                <td>
                    <a href="{{url('products/')}}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <div class="flex justify-center content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="transform transition-transform duration-500 ease-in-out" width="24" height="15" fill="currentColor" viewBox="0 -2 24 24" stroke="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>                        
                            <div>Volver</div>
                        </div> 
                    </div>
                    </a>
                </td>
                <td>
  
                            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-400 group-hover:text-blue-300 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">   
                                <div class="flex justify-center content-center">
                                    
                                <button type="submit"> {{$modo}} </button>
                                </div>    
                            </div>                            
              
          
            </div>
        </div>
   
       
<script type="text/javascript">

  function loadfile(event)
  {

    var output = document.getElementById('preimage');
    output.src=URL.createObjectURL(event.target.files[0]);

}

</script>



</x-app-layout>





<title>{{'Mis experiencias'}}</title>
<x-app-layout>
   <x-slot name="header">
      <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
         <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Mis experiencias') }}
            <span class="text-base sm:text-2xl block text-purple-300">
            Lista de experiencias
            </span>
         </h2>
      </div>
      <a href="{{url('experiences/create')}}">
         <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
            {{ __('Registrar experiencia')}}
         </div>
      </a>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
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
         <div class="bg-white shadow-xl sm:rounded-lg ">
            <x-data-table >
               <div class="flex items-center justify-center">
                  <div class="flex items-center justify-center">
                     <x-slot name="firstTheadTitle" >
                        {{ __('Titulo') }}
                     </x-slot>
                  </div>
                  <div class="flex items-center justify-center">
                     <x-slot name="secondTheadTitle">
                        {{ __('Descripción') }}
                     </x-slot>
                  </div>
                  <div class="flex items-center justify-center">
                     <x-slot name="tbodyData">
                     </x-slot>
                  </div>
                  <x-slot name="tbodyData">
                     @foreach( $experiences as $experience)
                     <tr class="border-b border-gray-200 hover:bg-gray-100 text-sm text-gray-600" >
                        <td class="py-3 px-2 text-rig whitespace-nowrap " >
                           <div >
                              <span>{{$experience->Title}}</span>
                           </div>
                        </td>
                        <td>
                           <div class=" " >
                              <span >{{$experience->Description}}</span>
                           </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                           <div class="flex item-center justify-center">
                              <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                 <a href="{{url('/experiences/'.$experience->id.'/')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                 </a>
                              </div>
                              <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                 <a href="{{url('/experiences/'.$experience->id.'/edit')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                 </a>
                              </div>
                              <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                 <form id="formDelete" action="{{url('/experiences/'.$experience->id)}}" method="post" >
                                    @csrf
                                    {{method_field('DELETE')}}                                  
                                    <a onclick="document.getElementById('formDelete').submit(); return confirm('¿Desea eliminar esta experiencia?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>            
                                    </a>
                                 </form>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </x-slot>
            </x-data-table>
            </div>
            {!! $experiences->links()!!}
         </div>
      </div>
   </div>
</x-app-layout>


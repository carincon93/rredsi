<title>{{'Ver Experiencias'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Buscar Experiencias') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    Lista de Experiencias
                </span>
            </h2>
        </div>
       
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white shadow-xl sm:rounded-lg ">
                <x-data-table >

                <div class="flex items-center justify-center">
                
                <x-slot name="firstTheadTitle" >
                {{ __('Titulo') }}
                </x-slot>
                </div>

                <div class="flex items-center justify-center">
                
                <x-slot name="secondTheadTitle" >
                {{ __('Nombre de la empresa') }}
                </x-slot>
                </div>
                
                <div class="flex items-center justify-center"> 
                    <x-slot name="tbodyData">
                
                    </x-slot>
                </div>

                    <x-slot name="tbodyData">

                    @foreach( $experiences as $experience)
                    

                    <tr class="border-b border-gray-200 hover:bg-gray-100 text-sm text-gray-600" >

                               


                                <td class="py-3 px-6 text-rig whitespace-nowrap " >
                                    <div >
                                        
                                        <span>{{ $experience->Title }} </span>
                                    </div>
                                </td>

                                <td class="py-3 px-6 text-rig whitespace-nowrap " >
                                    <div >
                                        <span>{{ $experience->name }}</span>
                                    </div>
                                </td>

                                
                                
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        
                                        <a href="{{url('/showexperiences/'.$experience->id.'/')}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

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


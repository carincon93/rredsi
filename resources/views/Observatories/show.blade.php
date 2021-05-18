
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Project') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    <a class="text-white font-weight underline" href="{{ route('observatories.index') }}" >Lista de proyectos</a> / Detalles del proyecto
                </span>
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

<div class="md:grid md:grid-cols-1 md:gap-4">
    <div>

    </div>
    <div>
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900">{{ __('Title of the project') }}</h3>
            <div class="text-justify text-sm text-gray-600">
                <p>
                    {{ $project->title }}
                </p>
            </div>
        </div>
    </div>
</div>  

    <div class="hidden sm:block">
                <div class="py-8">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-1 md:gap-4">
        <div>
        </div>
        <div>
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Project summary') }}</h3>
            <div class="text-justify text-sm text-gray-600">
                <p>
                    {{ $project->abstract }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="hidden sm:block">
                <div class="py-8">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-1 md:gap-4">
        <div>
        </div>
        <div>
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Educational institutions associated with the project') }}</h3>
            <div class="text-sm text-gray-600">
                <p>
                    {{ $educationalInstitution->name }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="hidden sm:block">
                <div class="py-8">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="md:grid md:grid-cols-1 md:gap-4">
        <div>
        </div>
        <div>
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('List of researchers associated with the project') }}</h3>
            <div class="mt-3 max-w-xl text-sm text-gray-600">
            @foreach ($project->authors as $author)
                <p>
                    {{ '- '.$author->name }}
                </p>
                @endforeach
            </div>
        </div>
    </div>
</div>
<br>
<div class="flex justify-center content-center">
    <table class="table-fixed">
        <tbody>
            <tr>
                <td>
                    <a href="{{ route('observatories.index') }}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <div class="flex justify-center content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="transform transition-transform duration-500 ease-in-out" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>                        
                            <div>{{ __('Back')}}</div>
                        </div> 
                    </div>
                    </a>
                </td>
                <td>
                    <form id="form" action={{ route('notifications.interes',[$project->id]) }} method="POST">
                    @csrf
                        <a href="#" onclick="document.getElementById('form').submit();">
                            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-400 group-hover:text-blue-300 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">   
                                <div class="flex justify-center content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="transform transition-transform duration-500 ease-in-out" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <div> {{ __('Generar Alerta de Interes')}}</div>
                                </div>    
                            </div>                            
                        </a>
                    </form>
                </td>                
            </ts>
        </tbody>
    </table>
</div>

 {{--Alert component --}}
 @if (session('status'))
 <x-data-alert />
@endif
</x-app-layout>

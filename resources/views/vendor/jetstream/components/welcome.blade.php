<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl">
        Bienvenido a la aplicación {{ config('app.name') }}!
    </div>

    <div class="mt-6 text-gray-500">
        Con la nueva plataforma {{ config('app.name') }} ahora puede buscar proyectos de su interés que se esten trabajando en los semilleros de investigación de las 10 instituciones educativas de RREDSI Caldas y colaborar en su desarrollo o registre su proyecto y conecte con jóvenes investigadores de otras instituciones.
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="40" viewBox="0 0 38 40" class="w-8 h-8 text-gray-400">
                <g transform="translate(-1654 -467)">
                  <path  d="M8.556,7.444V3m8.889,4.444V3m-10,8.889H18.556M5.222,23H20.778A2.222,2.222,0,0,0,23,20.778V7.444a2.222,2.222,0,0,0-2.222-2.222H5.222A2.222,2.222,0,0,0,3,7.444V20.778A2.222,2.222,0,0,0,5.222,23Z" transform="translate(1660 465)" fill="none" stroke="#9fa6b2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                  <text transform="translate(1654 504)" fill="#707070" font-size="11" font-family="SegoeUI, Segoe UI"><tspan x="0" y="0">Eventos</tspan></text>
                </g>
            </svg>

            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">{{ __('Node events') }}</a></div>
        </div>

        <div class="ml-12">
            @if (Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first())
            <div class="mt-2 text-sm text-gray-500">
                Revise cuales son los próximos eventos que las instituciones educativas van a celebrar. Si tiene proyectos que coincidan con el área de conocimiento del evento por favor participe, de esta manera se contribuye a la investigación académica de {{ Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first()->educationalInstitution->node->state }}. Valide la información y por favor haga el proceso de inscripción.
            </div>
            <a href="{{ route('nodes.explorer.events', [Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first()->educationalInstitution->node]) }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Explorar los eventos de nodo</div>

                    <div class="ml-1 text-blue-900">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
            @else
            <div class="mt-2 mb-2 text-sm text-gray-500">
                Revise cuales son los próximos eventos que las instituciones educativas van a celebrar. Si tiene proyectos que coincidan con el área de conocimiento del evento por favor participe, de esta manera se contribuye a la investigación académica. Valide la información y por favor haga el proceso de inscripción.
            </div>
            <a href="#">Seleccione un nodo en la opción Explorer</a>
            @endif
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('user.profile.user-graduations.index') }}">Información académica</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Por favor complete su información académica. De esta manera tendremos una base de datos de jóvenes investigadores integra para qué autores de proyecto y/o empresas puedan contactarlo(a) en caso de que lo requieran.
            </div>

            <a href="{{ route('user.profile.user-graduations.index') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Agregar información académica</div>

                    <div class="ml-1 text-blue-900">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"  class="w-8 h-8 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Connect</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                {{ config('app.name') }} permite la búsqueda de jóvenes investigadores que estén asociados a los semilleros de las demás instituciones educativas y solicitar su apoyo para el desarrollo de sus proyectos.
            </div>
            @if (Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first())
            <a href="{{ route('nodes.explorer.roles', [Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first()->educationalInstitution->node]) }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Contactar jóvenes investigadores</div>

                    <div class="ml-1 text-blue-900">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
            @else
                <a href="#">Seleccione un nodo en la opción Explorer</a>
            @endif
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Infraestructura / Equipos especializados</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                {{ config('app.name') }} le permite consultar sobre infraestructura y/o equipos especializados, de esta manera, si uno de sus proyectos requiere de algún laboratorio, ambiente, o equipo especializado, puede hacer una búsqueda y gestionar con los delegados de las instituciones de la red para hacer uso de ellos.
            </div>
            @if (Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first())
            <a href="{{ route('nodes.explorer', [Auth::user()->educationalInstitutionFaculties()->where('is_principal', 1)->first()->educationalInstitution->node]) }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Consultar infraestructura / Equipos especializados</div>

                    <div class="ml-1 text-blue-900">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </a>
            @else
                <a href="#">Seleccione un nodo en la opción Explorer</a>
            @endif
        </div>
    </div>
</div>
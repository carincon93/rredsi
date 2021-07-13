<title>{{'Ideas Empresariales'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Editar idea empresarial') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    {{$idea->name}}
                </span>
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Diligencia cada uno de los campos requeridos para editar la idea empresarial</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route ('business-ideas.update', [$idea->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mt-4" hidden>
                        <x-jet-label class="mb-4" for="id" value="{{ __('Name') }}" />
                        <x-jet-input id="id" class="block mt-1 w-full" type="number" name="id" value="{{ old('id') ?? $idea->id }}"/>
                        <x-jet-input-error for="id" class="mt-2" />
                    </div>
                    <div class="mt-4" hidden>
                        <x-jet-label class="mb-4" for="business_id" value="{{ __('Name') }}" />
                        <x-jet-input id="business_id" class="block mt-1 w-full" type="number" name="business_id" value="{{ old('business_id') ?? $idea->business_id }}"/>
                        <x-jet-input-error for="business_id" class="mt-2" />
                    </div>
                    {{--Nombre --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') ?? $idea->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    {{--Descripcion --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea rows="20" id="description" name="description" class="form-textarea border-0 w-full" value="{{ old('description') }}" >{{ old('description') ?? $idea->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    {{--Tipo --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="type" value="{{ __('Type') }}" />
                        <select id="type" name="type" class="form-select w-full" required >
                            <option value="{{$idea->type}}">{{$idea->type}}</option>
                            <option value="Idea">{{'Idea'}}</option>
                            <option value="Necesidad">{{'Necesidad'}}</option>
                            <option value="Problemática">{{'Problemática'}}</option>
                        </select>
                        <x-jet-input-error for="type" class="mt-2" />
                    </div>
                    {{--Tiene o no herramientas --}}
                    <div class="block mt-4">
                        <x-jet-label class="mb-4" for="have_tools" value="{{ __('Tiene herramientas') }}" />
                        <label for="have_tools_yes" class="flex items-center">
                            <input id="have_tools_yes" value="1" type="radio" class="form-radio" name="have_tools" {{ old('have_tools') == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="have_tools_no" class="flex items-center">
                            <input id="have_tools_no" value="0" type="radio" class="form-radio" name="have_tools" {{ old('have_tools') != null && old('have_tools')  == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>
                    {{--Cuantas herramientas tiene --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="tools" value="{{ __('Con cuáles herramientas cuenta (Separar por comas)') }}" />
                        <x-jet-input id="tools" class="block mt-1 w-full" type="text" max="191" name="tools" value="{{ old('tools') ?? $idea->tools }}"/>
                        <x-jet-input-error for="tools" class="mt-2" />
                    </div>
                    {{--Tiene o no presupuesto --}}
                    <div class="block mt-4">
                        <x-jet-label class="mb-4" for="have_money" value="{{ __('Tiene Presupuesto') }}" />
                        <label for="have_money_yes" class="flex items-center">
                            <input id="have_money_yes" value="1" type="radio" class="form-radio" name="have_money" {{ old('have_money') == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="have_money_no" class="flex items-center">
                            <input id="have_money_no" value="0" type="radio" class="form-radio" name="have_money" {{ old('have_money') != null && old('have_money')  == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>
                    {{--De cuanto es el presupuesto --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="money" value="{{ __('Monto para desarrollar la idea') }}" />
                        <x-jet-input id="money" class="block mt-1 w-full" type="number" name="money" value="{{ old('money') ?? $idea->money }}"/>
                        <x-jet-input-error for="money" class="mt-2" />
                    </div>
                    {{--Condición --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="condition" value="{{ __('Condición') }}" />
                        <select id="condition" name="condition" class="form-select w-full" required >
                            <option value="{{$idea->condition}}">{{$idea->condition}}</option>
                            <option value="Abierto">{{'Abierto'}}</option>
                            <option value="Sin respuesta">{{'Sin respuesta'}}</option>
                            <option value="Atendida">{{'Atendida'}}</option>
                            <option value="Resuelta">{{'Resuelta'}}</option>
                        </select>
                        <x-jet-input-error for="condition" class="mt-2" />
                    </div>

                    <hr class="mb-1/12">

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="mx-4">
                            {{ __('Actualizar idea') }}
                        </x-jet-button>
                        <a href="{{ route('business-ideas.index')}}">
                            <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'">
                                {{ __('Volver')}}
                            </div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- #Component modal --}}
    <x-dialog-desactivate-user />

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>

<title>{{'Ideas Empresariales'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Crear idea empresarial para:') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    {{$user_business->name}}
                </span>
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Diligencia cada uno de los campos requeridos para generar una nueva idea empresarial</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ Route ('business-ideas.store',[$user_business->id])}}">
                    @csrf
                    {{--Nombre --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" min="5" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    {{--Descripcion --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea rows="10" id="description" name="description" class=" resize-y form-textarea border-0 w-full " min="10" value="{{ old('description') }}" required ></textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                    {{--Tipo --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="type" value="{{ __('Type') }}" />
                        <select id="type" name="type" class="form-select w-full" required >
                            <option value="">Seleccione un tipo</option>
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
                        <x-jet-label class="mb-4" for="tools" value="{{ __('Con cuántas herramientas cuenta') }}" />
                        <x-jet-input id="tools" class="block mt-1 w-full" type="number" max="191" name="tools" value="{{ old('tools') }}" required />
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
                        <x-jet-input id="money" class="block mt-1 w-full" type="number" name="money" value="{{ old('money') }}" required />
                        <x-jet-input-error for="money" class="mt-2" />
                    </div>
                    {{--Condición --}}
                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="condition" value="{{ __('Condición') }}" />
                        <select id="condition" name="condition" class="form-select w-full" required >
                            <option value="">Seleccione una condición</option>
                            <option value="Abierto">{{'Abierto'}}</option>
                            <option value="Sin respuesta">{{'Sin respuesta'}}</option>
                            <option value="Atendida">{{'Atendida'}}</option>
                            <option value="Resuelta">{{'Resuelta'}}</option>
                        </select>
                        <x-jet-input-error for="condition" class="mt-2" />
                    </div>

                    <hr class="mb-1/12">

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>

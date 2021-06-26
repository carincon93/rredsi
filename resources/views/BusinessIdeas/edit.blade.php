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
                <form method="POST" action="#">
                    @csrf

                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') ?? $idea->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea rows="20" id="description" name="description" class="form-textarea border-0 w-full" value="{{ old('description') }}" >{{ old('description') ?? $idea->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

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
                        <x-jet-button class="ml-4">
                            {{ __('Update') }}
                        </x-jet-button>
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

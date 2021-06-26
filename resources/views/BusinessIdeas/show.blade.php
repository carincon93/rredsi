<title>{{'Ideas Empresariales'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Mostrar idea empresarial') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    {{$idea->name}}
                </span>
            </h2>
        </div>
    </x-slot>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                        <div class="mb-5 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $idea->name }}
                            </p>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Description') }}</h3>
                        <div class="mb-5 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $idea->description }}
                            </p>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Empresa') }}</h3>
                        <div class="mb-5 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $user_business->name }}
                            </p>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Condición') }}</h3>
                        <div class="mb-5 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $idea->condition }}
                            </p>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Type') }}</h3>
                        <div class="mb-5 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $idea->type }}
                            </p>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('business-ideas.index')}}">
                                <div class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'">
                                    {{ __('Volver')}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>

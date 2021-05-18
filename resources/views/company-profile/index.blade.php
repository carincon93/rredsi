<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-2xl md:text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Profile Company') }}
            <span class="lg:block text-purple-300">
                {{ Auth::user()->name }}
            </span>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name of the company') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $business->name }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Nit') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $business->nit }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('address') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $business->address }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Phone') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $business->cellphone_number }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Company communication email') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $business->email }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name of the person in charge of the module') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $user->name }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Responsible email') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $user->email }}
                        </p>
                    </div>
                    <br>
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Responsible phone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $user->cellphone_number }}
                        </p>
                    </div>
                    <br>
                    <a href="{{ route('company-profile.edit', [$user]) }}">
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('update data') }}
                            </x-jet-button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
           {{--Alert component --}}
    @if (session('status'))
    <x-data-alert />
@endif
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-6 gap-4  xl:grid-cols-9 xl:gap-3">
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Profile Company') }}
                    <span class="text-base sm:text-3xl block text-purple-300">
                        Update Profile Company
                    </span>
                </h2>
            </div>
    </x-slot>
    <div class="mt-5 md:mt-0 md:col-span-2">    
        <form method="POST" action="{{ route('company.update', [$business->id]) }}" >
            @csrf
            @method('PUT')
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-4" for="name" value="{{ __('Name of the company') }}" />
                <x-jet-input id="name" class="mt-1 block w-full" type="text" min="" max="" name="name" value="{{ old('name') ?? $business->name }}" required />
                <x-jet-input-error for="name" class="mt-2" />
            </div> 
                <!-- NIT -->                           
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-4" for="nit" value="{{ __('Nit') }}" />
                <x-jet-input id="nit" class="mt-1 block w-full" type="text" min="" max="" name="nit" value="{{ old('nit') ??  $business->nit }}" required />
                <x-jet-input-error for="nit" class="mt-2" />
            </div>
                <!-- Address -->        
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-4" for="address" value="{{ __('address') }}" />
                <x-jet-input id="address" class="mt-1 block w-full" type="text" min="" max="" name="address" value="{{ old('address') ?? $business->address }}" required />
                <x-jet-input-error for="address" class="mt-2" />
            </div>
                <!-- Cellphone number -->           
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-4" for="cellphone_number" value="{{ __('cellphone_number') }}" />
                <x-jet-input id="cellphone_number" class="mt-1 block w-full" type="number" min="" max="" name="cellphone_number" value="{{ old('cellphone_number') ?? $business->cellphone_number }}" required />
                <x-jet-input-error for="cellphone_number" class="mt-2" />
            </div>
                <!-- Email -->            
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="mb-4" for="email" value="{{ __('Company communication email') }}" />
                <x-jet-input id="email" class="mt-1 block w-full" type="email" min="" max="" name="email" value="{{ old('email') ?? $business->email }}" required />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('save Changes') }}
                </x-jet-button>
            </div>    
        </form>
    </div>
</x-app-layout>

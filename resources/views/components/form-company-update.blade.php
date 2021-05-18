@if(Auth::user()->hasRole(5))
    @php
    $user = auth()->user();
    $user->business()->get();
    $business = $user->business()->first();
    @endphp
    <x-jet-section-title>
        <x-slot name="title">
            {{ __('Company information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update information') }}
        </x-slot>
    </x-jet-section-title>
    <form method="POST" action="{{ route('company.update', [$business->id]) }}" >
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">                        
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
                </div>                             
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                <x-jet-button class="mr-3">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </div>
    </form>              
@endif      
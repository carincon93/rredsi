<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            accept="image/*"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label class="mb-4" for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- Cellphone number-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="cellphone_number" value="{{ __('Cellphone number') }}" />
            <x-jet-input id="cellphone_number" class="mt-1 block w-full" type="number" wire:model.defer="state.cellphone_number" autocomplete="cellphone_number"/>
            <x-jet-input-error for="cellphone_number" class="mt-2" />
        </div>

        <!-- Biography -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="biography" value="{{ __('Biography') }}" />
            {{-- <small class="inline-block text-gray-500">Separe con comas cada interés</small> --}}
            <textarea rows="20" id="biography" name="biography" class="form-textarea border-1 w-full" wire:model.defer="state.biography" autocomplete="biography" ></textarea>
            <x-jet-input-error for="biography" class="mt-2" />
        </div>

        <!-- cvlac -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="cvlac " value="{{ __('cvlac') }}" />
            <x-jet-input id="cvlac " class="mt-1 block w-full" type="url" max="191" wire:model.defer="state.cvlac" autocomplete="cvlac"/>
            <x-jet-input-error for="cvlac " class="mt-2" />
        </div>

        <!-- cv -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="mb-4" for="cv" value="{{ __('cv') }}" />
            <small class="inline-block text-gray-500">Solo admite pdf</small>
            <x-jet-input id="cv" class="mt-1 block w-full" type="file" accept="application/pdf" wire:model.defer="state.cv" autocomplete="cv" />
            <x-jet-input-error for="cv" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

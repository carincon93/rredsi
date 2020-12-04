<x-guest-layout>

    <x-guest-header :node="$node" />

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Enviar invitación de participación a {{ $user->name }}</x-slot>
                </x-jet-section-title>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.explorer.sendRoleNotification', [$node, $user]) }}">
                    @csrf

                    <div class="mt-4">
                        <x-jet-label for="project_id" value="{{ __('Projects') }}" />
                        <select id="project_id" name="project_id" class="form-select w-full" required >
                            <option value="">Seleccione un proyecto</option>
                            @forelse ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->title }}</option>
                            @empty
                                <option value="">No knowledge areas</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_id" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Send') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

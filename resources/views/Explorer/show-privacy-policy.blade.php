<title>{{'Declaración de privacidad'}}</title>

<x-guest-layout>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white m-auto max-w-xl mt-3 px-4 py-5 shadow sm:p-6 sm:rounded-lg text-gray-600 text-sm">
            <h2 class="text-center">Declaración de privacidad</h2>
            <p>
                {{ $privacyPolicy->description }}
            </p>
        </div>
    </div>

    <x-footer />

</x-guest-layout>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Educational tools
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="">
                    <p>Crear equipo / herramientas</p>
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <form action={{ route('educational-tools.store') }} method="POST" >
                                @csrf

                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                    />
                                    <div class="invalid-feedback">
                                        {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Descripcion</label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        class="form-control"
                                    ></textarea>
                                    <div class="invalid-feedback">
                                        {{-- {rules.description.message ? rules.description.message : requestValidation.description ? requestValidation.description : ''} --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input
                                        type="number"
                                        name="qty" id="qty"
                                        class="form-control "
                                    />
                                    <div class="invalid-feedback">
                                        {{-- {rules.qty.message ? rules.qty.message : requestValidation.qty ? requestValidation.qty : ''} --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">¿Habilitado?</label>
                                    <br />
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_enabled"
                                            id="inlineRadio1"
                                            value="1"
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_enabled"
                                            id="inlineRadio2"
                                            value="0"
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                    {{-- <div class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'}>
                                        {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''}
                                    </div> --}}
                                </div>
                                <div class="form-group">
                                    <label for="">¿Disponible?</label>
                                    <br />
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_available"
                                            id="inlineRadio3"
                                            value="1"
                                        />
                                        <label class="form-check-label" for="inlineRadio3">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_available"
                                            id="inlineRadio4"
                                            value="0"
                                        />
                                        <label class="form-check-label" for="inlineRadio4">No</label>
                                    </div>
                                    {{-- <div class={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block': 'invalid-feedback'}>
                                        {rules.is_available.message ? rules.is_available.message : requestValidation.is_available ? requestValidation.is_available : ''}
                                    </div> --}}
                                </div>


                                @if ( $educationalEnvironments )
                                    <div class="form-group">
                                        <label for="">Ambiente</label>
                                        <select
                                            name="educational_environment_id"
                                            id="educational_environment_id"
                                            class="form-control"
                                        >
                                            <option value="">Seleccione un ambiente</option>

                                            @forelse ($educationalEnvironments as $educationalEnvironment)
                                                <option value={{ $educationalEnvironment->id }} > {{ $educationalEnvironment->name }} </option>
                                            @empty
                                                <option value="">No educational environments</option>
                                            @endforelse

                                        </select>
                                        <div class="invalid-feedback">
                                            {{-- {rules.educational_environment_id.message ? rules.educational_environment_id.message : requestValidation.educational_environment_id ? requestValidation.educational_environment_id : ''} --}}
                                        </div>
                                    </div>
                                @else

                                    <div></div>

                                @endif

                                <div class="form-group">
                                    <button type="submit" >Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


</div>


</x-app-layout>

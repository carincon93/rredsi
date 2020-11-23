<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create researcher
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                    <form action={{ route('researchers.store')}} method="POST">
                        @csrf

                        <div class="form-group">
                        <label for="name">name</label>
                        <small id="nameHelp" class="form-text text-muted">Campo requerido</small>
                        <input type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            aria-describedby="nameHelp"
                            maxLength=""
                            autoFocus
                            required

                        />
                        <span class="invalid-feedback">
                            {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="email">email</label>
                        <small id="emailHelp" class="form-text text-muted">Campo requerido</small>
                        <input type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            aria-describedby="emailHelp"
                            maxLength=""
                            required
                        />
                        <span class="invalid-feedback">
                            {{-- {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="document_type">document_type</label>
                        <small id="document_typeHelp" class="form-text text-muted">Campo requerido</small>
                        <select id="document_type"
                            name="document_type"
                            class="form-control"
                            required
                        >
                            <option value=''>Seleccione el tipo de documento</option>
                            <option value="CC">Cédula de ciudadanía</option>
                            <option value="CE">Cédula de extranjería</option>
                            <option value="TI">Tarjeta de identidad</option>
                        </select>
                        <span class="invalid-feedback">
                            {{-- {rules.document_type.message ? rules.document_type.message : requestValidation.document_type ? requestValidation.document_type : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="document_number">document_number</label>
                        <small id="document_numberHelp" class="form-text text-muted">Campo requerido</small>
                        <input type="number"
                            name="document_number"
                            class="form-control"
                            id="document_number"
                            aria-describedby="document_numberHelp"
                            min="0"
                            max=""
                            required
                        />
                        <span class="invalid-feedback">
                            {{-- {rules.document_number.message ? rules.document_number.message : requestValidation.document_number ? requestValidation.document_number : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="cellphone_number">cellphone_number</label>
                        <small id="cellphone_numberHelp" class="form-text text-muted">Campo requerido</small>
                        <input type="number"
                            name="cellphone_number"
                            class="form-control"
                            id="cellphone_number"
                            aria-describedby="cellphone_numberHelp"
                            min="0"
                            max=""
                            required
                        />
                        <span class="invalid-feedback">
                            {{-- {rules.cellphone_number.message ? rules.cellphone_number.message : requestValidation.cellphone_number ? requestValidation.cellphone_number : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="status">status</label>
                        <small id="statusHelp" class="form-text text-muted">Campo requerido</small>
                        <select id="status"
                            name="status"
                            class="form-control"
                            required
                        >
                            <option value=''>Seleccione el estado</option>
                            <option value="Aceptado">Aceptado</option>
                            <option value="En espera">En espera</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                        <span class="invalid-feedback">
                            {{-- {rules.status.message ? rules.status.message : requestValidation.status ? requestValidation.status : ''} --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="interests">interests</label>
                        <small id="interestsHelp" class="form-text text-muted">Campo requerido</small>
                        <textarea
                            name="interests"
                            class="form-control"
                            id="interests"
                            rows="3"
                        >
                        </textarea>
                        <span class="invalid-feedback">
                            {{-- {rules.interests.message ? rules.interests.message : requestValidation.interests ? requestValidation.interests : ''} --}}
                        </span>
                        </div>

                        <div>
                        <label>is_enabled</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="is_enabled_yes" name="is_enabled" class="custom-control-input"   value="1" />
                            <label class="custom-control-label" for="is_enabled_yes">Si</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="is_enabled_no" name="is_enabled" class="custom-control-input"   value="0" />
                            <label class="custom-control-label" for="is_enabled_no">No</label>
                        </div>

                        {{-- <span class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'} >
                            {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : '' }
                        </span> --}}
                        </div>

                        <input type="hidden" name="role_id" defaultValue="5"  />

                        <div class="form-group">
                        <label for="educational_institution_id">educational_institution_id</label>
                        <small id="educational_institution_idHelp" class="form-text text-muted">Campo requerido</small>
                        <select id="educational_institution_id"
                            name="educational_institution_id"
                            class="form-control"
                            required
                        >
                            <option value=''>Seleccione una institución educativa</option>

                            @forelse ($educationalInstitutions as $educationalInstitution)
                                <option value={{ $educationalInstitution->id }} >{{ $educationalInstitution->name }}</option>
                            @empty
                                <option value="">No educational institutions</option>
                            @endforelse

                        </select>
                        <span class="invalid-feedback">
                            {{-- {rules.educational_institution_id.message ? rules.educational_institution_id.message : '' } --}}
                        </span>
                        </div>

                        <div class="form-group">
                        <label for="research_group_id">research_group_id</label>
                        <small id="research_group_idHelp" class="form-text text-muted">Campo requerido</small>
                        <select id="research_group_id"
                            name="research_group_id"
                            class="form-control"
                            required
                        >
                            <option value=''>Seleccione un grupo de investigación</option>

                            @forelse ($researchGroups as $researchGroup)
                                <option value={{ $researchGroup->id }} > {{$researchGroup->name }}</option>
                            @empty
                                <option value="">No research groups</option>
                            @endforelse

                        </select>
                        <span class="invalid-feedback">
                            {{-- {rules.research_group_id.message ? rules.research_group_id.message : '' } --}}
                        </span>
                        </div>

                        <div>
                        <label>research_team_id</label>

                        @forelse ($researchTeams as $researchTeam)
                            <div class="custom-control custom-checkbox" key={researchTeam.id}>
                                <input type="checkbox" name="research_team_id[]" class="custom-control-input" id={{$researchTeam->id}} defaultValue={{$researchTeam->id}}  />
                                <label class="custom-control-label" for={{$researchTeam->id}}>{{$researchTeam->name}}</label>
                            </div>
                        @empty
                            <div>No research teams</div>
                        @endforelse

                        {{-- <span class={rules.research_team_id.isInvalid && rules.research_team_id.message !== '' || requestValidation.research_team_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                            {rules.research_team_id.message ? rules.research_team_id.message : requestValidation.research_team_id ? requestValidation.research_team_id : '' }
                        </span> --}}
                        </div>

                        <div class="form-group">
                        <label for="cvlac">cvlac</label>
                        <small id="cvlacHelp" class="form-text text-muted">Campo requerido</small>
                        <input type="url"
                            name="cvlac"
                            class="form-control"
                            id="cvlac"
                            aria-describedby="cvlacHelp"
                            maxLength=""
                            required
                        />
                        <span class="invalid-feedback">
                            {{-- {rules.cvlac.message ? rules.cvlac.message : requestValidation.cvlac ? requestValidation.cvlac : ''} --}}
                        </span>
                        </div>

                        <div>
                        <label>is_accepted</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="is_accepted_yes" name="is_accepted" class="custom-control-input"   value="1" />
                            <label class="custom-control-label" for="is_accepted_yes">Si</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="is_accepted_no" name="is_accepted" class="custom-control-input"   value="0" />
                            <label class="custom-control-label" for="is_accepted_no">No</label>
                        </div>

                        {{-- <span class={rules.is_accepted.isInvalid && rules.is_accepted.message !== '' || requestValidation.is_accepted ? 'invalid-feedback d-block': 'invalid-feedback'} >
                            {rules.is_accepted.message ? rules.is_accepted.message : requestValidation.is_accepted ? requestValidation.is_accepted : ''}
                        </span> --}}
                        </div>
                        <button type="submit">Guardar</button>
                    </form>
                    </div>
                </div>


            </div>

        </div>

    </div>


</x-app-layout>

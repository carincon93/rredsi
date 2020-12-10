<div class="mt-4">
    <x-jet-label for="node_id" value="{{ __('Node') }}" />
    <select class="form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" id="node_id" name="node_id" required onchange="AcademicProgramsFilter.onChangeNodeSelect(event)">
        <option value="">Seleccione un nodo</option>
        @foreach ($nodes as $node)
            <option value="{{ $node->id }}" {{ old('node_id') == $node->id || optional(optional(optional($academicProgram)->educationalInstitution)->node)->id == $node->id ? 'selected' : '' }}>{{ $node->state }}</option>
        @endforeach
    </select>
</div>
<div class="mt-4">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 educational_institution_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label for="educational_institution_id" value="{{ __('Educational institution') }}" />
    </div>
    <select class="form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="educational_institution_id" name="educational_institution_id" required onchange="AcademicProgramsFilter.onChangeEducationalInstitutionSelect(event)">
        <option value="">Seleccione una institución educativa</option>
    </select>
</div>
<div class="mt-4">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 academic_program_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label for="academic_program_id" value="{{ __('Academic program') }}" />
    </div>
    <select class="form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="academic_program_id" name="academic_program_id" required>
        <option value="">Seleccione un programa de formación</option>
    </select>
    <x-jet-input-error for="academic_program_id" class="mt-2" />
</div>

@once
    @push('scripts')
        <script>
            let academicProgramEdit            = {{ $academicProgram ? $academicProgram->id : 0 }};
            let nodeIdOld                     = {{ old('node_id') != '' ? old('node_id') : 0 }};
            let educationalInstitutionIdOld   = {{ old('educational_institution_id') != '' ? old('educational_institution_id') : 0 }};
            let academicProgramIdOld          = {{ old('academic_program_id') != '' ? old('academic_program_id') : 0 }};

            var AcademicProgramsFilter = (function() {
                let nodeId = null;
                const educationalInstitutionsSelect = document.getElementById('educational_institution_id');
                const academicProgramsSelect        = document.getElementById('academic_program_id');
                const educationalInstitutionsSpin   = document.querySelector('.educational_institution_id_spin');
                const academicProgramsSpin          = document.querySelector('.academic_program_id_spin');

                getEducationalInstitutions = async (nodeId, educationalInstitutionId) => {
                    educationalInstitutionsSelect.setAttribute('disabled', 'disabled');
                    academicProgramsSelect.setAttribute('disabled', 'disabled');
                    educationalInstitutionsSelect.innerHTML = '<option value="">Seleccione una institución educativa</option>';
                    academicProgramsSelect.innerHTML        = '<option value="">Seleccione un programa de formación</option>';

                    if (nodeId != null && nodeId != '') {
                        educationalInstitutionsSpin.classList.remove('hidden');
                        educationalInstitutionsSpin.classList.add('inline');
                        try {
                            const uri       = `/api/nodes/${nodeId}/educational-institutions`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.educationalInstitutions.map(function(educationalInstitution) {
                                educationalInstitutionsSelect.removeAttribute('disabled');
                                let option = `<option value="${educationalInstitution.id}">${educationalInstitution.name}</option>`;
                                educationalInstitutionsSelect.innerHTML += option;
                            })

                            if (result.educationalInstitutions.length > 0) {
                                educationalInstitutionsSpin.classList.remove('inline');
                                educationalInstitutionsSpin.classList.add('hidden');
                            }

                            if (educationalInstitutionId != null) {
                                educationalInstitutionsSelect.querySelector(`option[value="${educationalInstitutionId}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                getAcademicPrograms = async (nodeId, educationalInstitutionId, academicProgramId) => {
                    academicProgramsSelect.setAttribute('disabled', 'disabled');
                    academicProgramsSelect.innerHTML = '<option value="">Seleccione un programa de formación</option>';

                    console.log(nodeId);
                    console.log(educationalInstitutionId);
                    console.log(academicProgramId);

                    if (nodeId != null && educationalInstitutionId != null && nodeId != '' && educationalInstitutionId != '') {
                        academicProgramsSpin.classList.remove('hidden');
                        academicProgramsSpin.classList.add('inline');
                        try {
                            const uri       = `/api/nodes/${nodeId}/educational-institutions/${educationalInstitutionId}/academic-programs`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.academicPrograms.map(function(academicProgram) {
                                academicProgramsSelect.removeAttribute('disabled');
                                let option = `<option value="${academicProgram.id}">${academicProgram.name}</option>`;
                                academicProgramsSelect.innerHTML += option;
                            })

                            if (result.academicPrograms.length > 0) {
                                academicProgramsSpin.classList.remove('inline');
                                academicProgramsSpin.classList.add('hidden');
                            }

                            if (academicProgramId != null) {
                                academicProgramsSelect.querySelector(`option[value="${academicProgramId}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                if (nodeIdOld != 0 && educationalInstitutionIdOld != 0 && academicProgramIdOld != 0) {
                    getEducationalInstitutions(nodeIdOld, educationalInstitutionIdOld);
                    getAcademicPrograms(nodeIdOld, educationalInstitutionIdOld, academicProgramIdOld);
                }

                function retrieveData() {
                    let nodeIdEdit = {{ optional(optional(optional($academicProgram)->educationalInstitution)->node)->id ?? 0 }};
                    let academicProgramIdEdit = {{ optional($academicProgram)->id ?? 0 }};
                    let educationalInstitutionIdEdit = {{ optional(optional($academicProgram)->educationalInstitution)->id ?? 0 }};

                    if (nodeIdEdit != 0 && educationalInstitutionIdEdit != 0 && academicProgramIdEdit != 0) {
                        getEducationalInstitutions(nodeIdEdit, educationalInstitutionIdEdit);
                        getAcademicPrograms(nodeIdEdit, educationalInstitutionIdEdit, academicProgramIdEdit);
                    }
                }

                return {
                    onChangeNodeSelect: function(e) {
                        nodeId = e.target.value;
                        getEducationalInstitutions(nodeId, null);
                    },
                    onChangeEducationalInstitutionSelect: function(e) {
                        if (nodeIdOld != null && nodeIdOld != 0) {
                            nodeId = nodeIdOld;
                        } else {
                            nodeId = document.getElementById('node_id').value;
                        }
                        getAcademicPrograms(nodeId, e.target.value, null);
                    },
                    retrieveData: function() {
                        retrieveData();
                    }
                }
            })();

            if (academicProgramEdit > 0 && nodeIdOld == 0 && educationalInstitutionIdOld == 0 && academicProgramIdOld == 0) {
                AcademicProgramsFilter.retrieveData();
            }
        </script>
    @endpush
@endonce

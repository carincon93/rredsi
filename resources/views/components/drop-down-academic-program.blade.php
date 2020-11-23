<div class="mt-4">
    <x-jet-label for="educational_institution_id" value="{{ __('Educational institution') }}" />
    <select class="form-input rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" id="educational_institution_id" name="educational_institution_id" required onchange="onChange(event)">
        <option value="">Seleccione una institución educativa</option>
        @foreach ($educationalInstitutions as $educationalInstitution)
            <option value="{{ $educationalInstitution->id }}" {{ old('educational_institution_id') == $educationalInstitution->id ? 'selected' : '' }}>{{ $educationalInstitution->name }}</option>
        @endforeach
    </select>
</div>
<div class="mt-4">
    <x-jet-label for="academic_program_id" value="{{ __('Academic program') }}" />
    <select class="form-input rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="academic_program_id" name="academic_program_id" required>
        <option value="">Seleccione un programa de formación</option>
    </select>
    <x-jet-input-error for="academic_program_id" class="mt-2" />
</div>

@once
    @push('scripts')
        <script>
            function onChange(e) {
                getAcademicPrograms(e.target.value, null);
            }
        
            getAcademicPrograms = async (educationalInstitutionId, academicProgramId) => {
                const academicProgramsSelect   = document.getElementById('academic_program_id');
                academicProgramsSelect.innerHTML = '<option value="">Seleccione un programa de formación</option>';

                if (educationalInstitutionId != 0) {
                    try {
                        const uri       = `/educational-institutions/get-academic-programs/${educationalInstitutionId}`;
                        const response  = await fetch(uri);
                        const result    = await response.json();

                        result.academicPrograms.map(function(academicProgram) {
                            academicProgramsSelect.removeAttribute('disabled');
                            let option = `<option value="${academicProgram.id}">${academicProgram.name}</option>`;
                            academicProgramsSelect.innerHTML += option;
                        })

                        if (academicProgramId != 0) {
                            console.log('ok');
                            academicProgramsSelect.querySelector(`option[value="${academicProgramId}"]`).setAttribute('selected', 'selected');
                        }
                    } catch (error) {
                        console.log(error);
                    }
                }
            }
            
            const educationalInstitutionIdOld  = {{ old('educational_institution_id') != '' ? old('educational_institution_id') : 0 }};
            const academicProgramIdOld         = {{ old('academic_program_id') != '' ? old('academic_program_id') : 0 }};
            if (educationalInstitutionIdOld != 0 && academicProgramIdOld != 0) {
                getAcademicPrograms(educationalInstitutionIdOld, academicProgramIdOld);
            }
        </script>
    @endpush
@endonce
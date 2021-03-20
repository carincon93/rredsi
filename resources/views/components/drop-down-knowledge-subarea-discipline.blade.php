
<div class="mt-4">
    <x-jet-label class="mb-4" for="node_id" value="{{ __('Knowledge subarea disciplines')}} " />
    <select class="form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" id="knowledge_area_id" name="knowledge_area_id" required onchange="SwitchknowledgeSubareasDisciplines.onChange(event)">
    </select>
</div>
<input id="areaOldId" class="hidden" />

<div class="mt-4">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 knowledge_subarea_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label class="mb-4" for="educational_institution_id" value="{{ __('Knowledge subarea') }}" />
    </div>
    <select class="mr-10 focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="knowledge_subarea_id" name="knowledge_subarea_id" required onchange="SwitchknowledgeSubareasDisciplines.onChangeDisciplines(event)">
        <option value="">Seleccione un sub-area de conocimiento</option>
    </select>
</div>

<input id="subAreaOldId" class="hidden" />

<div class="mt-4">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 knowledge_subarea_discipline_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label class="mb-4" for="educational_institution_id" value="{{ __('Knowledge subarea discipline') }}" />
    </div>
    <select class="mr-10 focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="knowledge_subarea_discipline_id" name="knowledge_subarea_discipline_id" required>
        <option value="">Seleccione una disciplina de sub-area de conocimiento</option>
    </select>
</div>


{{-- <div class="mt-4" id="check">
    <x-jet-input-error for="knowledge_subarea_discipline_id" class="mt-2" />
</div> --}}

<input id="subareaDisciplineOldId" class="hidden" />


@once
    @push('scripts')
        <script>
            let knowledgeAreaIdOld  = null;
            let knowledgeSubareaIdOld  = null;
            // let knowledgeSubareaDisciplinesIdOld  = null;

            // areaOld asignacion
            let areaOldId = document.getElementById('areaOldId');
            areaOldId.innerHTML = '{{old('knowledge_area_id')}}';

            if(areaOldId.value != null && areaOldId.value != 0 ){
                knowledgeAreaIdOld = areaOldId.value;
            }

            let subAreaOldId = document.getElementById('subAreaOldId');
            subAreaOldId.innerHTML = '{{old('knowledge_subarea_id')}}';

            if(subAreaOldId.value != null && subAreaOldId.value != 0 ){
                knowledgeSubareaIdOld = subAreaOldId.value;
            }

            var SwitchknowledgeSubareasDisciplines = (function() {
                let knowledgeAreaId                           = null;
                const knowledge_subarea_id_spin                         = document.querySelector('.knowledge_subarea_id_spin');
                const knowledge_subarea_discipline_id_spin              = document.querySelector('.knowledge_subarea_discipline_id_spin');
                // const knowledgeAreaSelected                   = {{ request()->route('knowledge-areas') != null ? request()->route('knowledge-areas')->id : 0 }};
                // const knowledgeSubareaSelected                = {{ request()->route('knowledge-subareas') != null ? request()->route('knowledge-subareas')->id : 0 }};
                // const knowledgeSubareaDisciplineselected       = {{ request()->route('knowledge-subarea-disciplines') != null ? request()->route('knowledge-subarea-disciplines')->id : 0 }};

                getAllknowledgeAreas = async (knowledgeAreaselected) => {
                const knowledgeAreasSelect                     = document.getElementById('knowledge_area_id');
                knowledgeAreasSelect.innerHTML = '<option value="">Seleccione un area de conocimiento</option>';

                try {
                        const uri       = `/api/knowledge-areas`;
                        const response  = await fetch(uri);
                        const result    = await response.json();


                        result.knowledgeAreas.map(function(knowledgeArea) {
                            knowledgeAreasSelect.removeAttribute('disabled','disabled');
                            let option = `<option  value="${knowledgeArea.id}">${knowledgeArea.name}</option>`;
                            knowledgeAreasSelect.innerHTML += option;
                        })

                        if (knowledgeAreaselected != 0) {
                            knowledgeAreasSelect.querySelector(`option[value="${knowledgeAreaselected}"]`).setAttribute('selected', 'selected');
                        }
                    } catch (error) {
                        console.log(error);
                    }
            }

                getAllknowledgeSubareas  = async (knowledgeArea, knowledgeSubareaId) => {
                    const knowledgeSubareaidSelect   = document.getElementById('knowledge_subarea_id');
                    knowledgeSubareaidSelect.innerHTML = '<option value="">Seleccione un sub-area de conocimiento</option>';

                    if (knowledgeArea != 0) {
                        knowledge_subarea_id_spin.classList.remove('hidden');
                        knowledge_subarea_id_spin.classList.add('inline');
                        try {
                            const uri       = `/api/knowledge-areas/${knowledgeArea}/knowledge-subareas`;
                            const response  = await fetch(uri);
                            const result    = await response.json();


                            result.KnowledgeSubareas.map(function(knowledgeSubarea) {
                                knowledgeSubareaidSelect.removeAttribute('disabled');
                                let option = `<option value="${knowledgeSubarea.id}">${knowledgeSubarea.name}</option>`;
                                knowledgeSubareaidSelect.innerHTML += option;
                            })

                            if (result.KnowledgeSubareas.length > 0) {
                                knowledge_subarea_id_spin.classList.remove('inline');
                                knowledge_subarea_id_spin.classList.add('hidden');
                            }

                            if (knowledgeSubareaId != 0) {
                                knowledgeSubareaidSelect.querySelector(`option[value="${knowledgeSubareaId}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                getAllknowledgeSubareaDisciplines  = async (knowledgeArea, knowledgeSubarea, knowledgeSubareaDisciplineId) => {
                    const knowledgeSubareaDisciplineidSelect   = document.getElementById('knowledge_subarea_discipline_id');

                    if (knowledgeArea != 0 && knowledgeSubarea != 0 ) {
                        knowledge_subarea_discipline_id_spin.classList.remove('hidden');
                        knowledge_subarea_discipline_id_spin.classList.add('inline');
                        try {
                            const uri       = `/api/knowledge-areas/${knowledgeArea}/knowledge-subareas/${knowledgeSubarea}/knowledge-subarea-disciplines`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.KnowledgeSubareaDiscipline.map(function(KnowledgeSubareaDiscipline) {
                                knowledgeSubareaDisciplineidSelect.removeAttribute('disabled');
                                let option = `<option value="${KnowledgeSubareaDiscipline.id}">${KnowledgeSubareaDiscipline.name}</option>`;
                                knowledgeSubareaDisciplineidSelect.innerHTML += option;
                            })

                            if (result.KnowledgeSubareaDiscipline.length > 0) {
                                knowledge_subarea_discipline_id_spin.classList.remove('inline');
                                knowledge_subarea_discipline_id_spin.classList.add('hidden');
                            }

                            // if (knowledgeSubareaDisciplineId != 0) {
                            //     knowledgeSubareaDisciplineidSelect.querySelector(`input [value="${knowledgeSubareaDisciplineId}"]`).setAttribute('checked', 'checked');
                            // }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                if (knowledgeAreaIdOld != null && knowledgeSubareaIdOld != null) {
                    getAllknowledgeAreas(knowledgeAreaIdOld);
                    getAllknowledgeSubareas(knowledgeAreaIdOld, knowledgeSubareaIdOld);
                    getAllknowledgeSubareaDisciplines(knowledgeAreaIdOld,knowledgeSubareaIdOld);
                }



                return {
                    getAllknowledgeAreas: function() {
                        getAllknowledgeAreas();
                    },
                    onChange: function(e) {
                        knowledgeAreaId = e.target.value;
                        getAllknowledgeSubareas (knowledgeAreaId, null);
                    },
                    onChangeDisciplines: function(e) {
                        knowledgeSubareaId = e.target.value;
                        if (knowledgeAreaIdOld != null && knowledgeAreaIdOld != 0) {
                            knowledgeareaId = knowledgeAreaIdOld;
                        } else {
                            knowledgeareaId = document.getElementById('knowledge_area_id').value;
                        }
                        getAllknowledgeSubareaDisciplines(knowledgeareaId, knowledgeSubareaId, null);
                    },
                    redirect: function(e) {
                        if (!knowledgeAreaId && knowledgeAreaSelected != 0) {
                            knowledgeAreaId = knowledgeAreaSelected;
                        }
                        // window.location = `/dashboard/knowledgeAreas/${knowledgeAreaId}/educational-institutions/${e.target.value}`;
                    }
                }
            })();

            SwitchknowledgeSubareasDisciplines.getAllknowledgeAreas();


        </script>
    @endpush
@endonce

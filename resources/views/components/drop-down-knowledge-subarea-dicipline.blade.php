
<div class="mt-4">
    <p class="mt-4">{{ __('Knowledge subarea disciplines')}} </p>
    <select class="form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" id="knowledge_area_id" name="knowledge_area_id" required onchange="SwitchknowledgeSubareasDisciplines.onChange(event)">
    </select>
</div>
<textarea id="areaOldId" class="hidden"></textarea>

<div class="ml-4">
    <select class="mr-10 focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="knowledge_subarea_id" name="knowledge_subarea_id" required onchange="SwitchknowledgeSubareasDisciplines.onChangeDisciplines(event)">
        <option value="">Seleccione un sub-area de conocimiento</option>
    </select>
    <x-jet-input-error for="knowledge_subarea_id" class="mt-2" />
</div>

<textarea id="subAreaOldId" class="hidden"></textarea>


<div class="ml-4">
    <select class="mr-10 focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="knowledge_subarea_discipline_id" name="knowledge_subarea_discipline_id" required>
        <option value="">Seleccione una disciplina de sub-area de conocimiento</option>
    </select>
    <x-jet-input-error for="knowledge_subarea_discipline_id" class="mt-2" />
</div>


{{-- <div class="mt-4" id="check">
    <x-jet-input-error for="knowledge_subarea_discipline_id" class="mt-2" />
</div> --}}

<textarea id="subAreaDiciplineOldId" class="hidden"></textarea>


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
                console.log(knowledgeAreaIdOld);
            }

            let subAreaOldId = document.getElementById('subAreaOldId');
            subAreaOldId.innerHTML = '{{old('knowledge_subarea_id')}}';

            if(subAreaOldId.value != null && subAreaOldId.value != 0 ){
                knowledgeSubareaIdOld = subAreaOldId.value;
                console.log(knowledgeSubareaIdOld);
            }

            console.log(typeof('{{old('knowledge_subarea_dicipline_id')}}'));



            var SwitchknowledgeSubareasDisciplines = (function() {
                let knowledgeAreaId                           = null;
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
                        try {
                            const uri       = `/api/knowledge-areas/${knowledgeArea}/knowledge-subareas`;
                            const response  = await fetch(uri);
                            const result    = await response.json();


                            result.KnowledgeSubareas.map(function(knowledgeSubarea) {
                                knowledgeSubareaidSelect.removeAttribute('disabled');
                                let option = `<option value="${knowledgeSubarea.id}">${knowledgeSubarea.name}</option>`;
                                knowledgeSubareaidSelect.innerHTML += option;
                            })

                            if (knowledgeSubareaId != 0) {
                                knowledgeSubareaidSelect.querySelector(`option[value="${knowledgeSubareaId}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                getAllknowledgeSubareaDisciplines  = async (knowledgeArea, knowledgeSubarea, knowledgeSubareaDiciplineId) => {
                    const knowledgeSubareaDiciplineidSelect   = document.getElementById('knowledge_subarea_discipline_id');

                    if (knowledgeArea != 0 && knowledgeSubarea != 0 ) {
                        try {
                            const uri       = `/api/knowledge-areas/${knowledgeArea}/knowledge-subareas/${knowledgeSubarea}/knowledge-subarea-disciplines`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.KnowledgeSubareaDiscipline.map(function(KnowledgeSubareaDiscipline) {
                                knowledgeSubareaDiciplineidSelect.removeAttribute('disabled');
                                let option = `<option value="${KnowledgeSubareaDiscipline.id}">${KnowledgeSubareaDiscipline.name}</option>`;
                                knowledgeSubareaDiciplineidSelect.innerHTML += option;
                            })

                            // if (knowledgeSubareaDiciplineId != 0) {
                            //     knowledgeSubareaDiciplineidSelect.querySelector(`input [value="${knowledgeSubareaDiciplineId}"]`).setAttribute('checked', 'checked');
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

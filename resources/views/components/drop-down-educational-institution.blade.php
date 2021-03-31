<div>
    <div>
        <select class="overflow-hidden bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full pr-11" id="h_node_id" name="h_node_id" required onchange="SwitchEducationalInstitution.onChange(event)">
            <option value="">Seleccione un nodo</option>
        </select>
    </div>

    <div>
        <div class="flex">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 educational_institution_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <x-jet-label class="mb-4" for="educational_institution_id" value="{{ __('Educational institution') }}" />
        </div>
        <select class="overflow-hidden bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full pr-11" disabled id="h_educational_institution_id" name="h_educational_institution_id" required onchange="SwitchEducationalInstitution.redirect(event)">
            <option value="">Seleccione una institución educativa</option>
        </select>
        <x-jet-input-error for="h_educational_institution_id" class="mt-2" />
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener(
                            "DOMContentLoaded",
                                function() {

                                    window.educationalInstitutionsSpin               = document.querySelector(".educational_institution_id_spin");

                        }, false)

            var SwitchEducationalInstitution = (function() {
                let nodeId                           = null;
                const nodeAdmin                      = {{ auth()->user()->isNodeAdmin != null ? auth()->user()->isNodeAdmin->id : 0}};
                const educationalInstitutionAdmin    = {{ auth()->user()->isEducationalInstitutionAdmin != null ? auth()->user()->isEducationalInstitutionAdmin->id : 0}};
                const researchTeamAdmin              = {{ auth()->user()->isResearchTeamAdmin != null ? auth()->user()->isResearchTeamAdmin->id : 0}};

                if (!nodeAdmin) {
                    nodeSelected = {{ request()->route('node') != null ? request()->route('node')->id : 0 }};
                } else {
                    nodeSelected = nodeAdmin;
                }

                if (!educationalInstitutionAdmin) {
                    educationalInstitutionSelected = {{ request()->route('educational_institution') != null ? request()->route('educational_institution')->id : 0 }};
                } else {
                    nodeSelected                   = {{ auth()->user()->isEducationalInstitutionAdmin->node != null ? auth()->user()->isEducationalInstitutionAdmin->node->id : 0}};
                    educationalInstitutionSelected = educationalInstitutionAdmin;
                }

                if (document.getElementById('h_node_id')) {
                    nodesSelect = document.getElementById('h_node_id');
                }

                getAllNodes = async () => {
                    nodesSelect.innerHTML = '<option value="">Seleccione un nodo</option>';
                    try {
                            const uri       = `/api/nodes`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.nodes.map(function(node) {
                                nodesSelect.removeAttribute('disabled');
                                let option = `<option value="${node.id}">${node.state}</option>`;
                                nodesSelect.innerHTML += option;
                            })

                            if (nodeSelected != 0) {
                                nodesSelect.querySelector(`option[value="${nodeSelected}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                }

                getAllEducationalInstitutions = async (node, educationalInstitutionId) => {
                    const educationalInstitutionsSelect   = document.getElementById('h_educational_institution_id');
                    educationalInstitutionsSelect.innerHTML = '<option value="">Seleccione una institución educativa</option>';

                    if (node != 0) {
                        educationalInstitutionsSpin.classList.remove('hidden');
                        educationalInstitutionsSpin.classList.add('inline');
                        try {
                            const uri       = `/api/nodes/${node}/educational-institutions/`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.educationalInstitutions.map(function(academicProgram) {
                                educationalInstitutionsSelect.removeAttribute('disabled');
                                let option = `<option value="${academicProgram.id}">${academicProgram.name}</option>`;
                                educationalInstitutionsSelect.innerHTML += option;
                            })

                            if (result.educationalInstitutions.length > 0) {
                                educationalInstitutionsSpin.classList.remove('inline');
                                educationalInstitutionsSpin.classList.add('hidden');
                            }

                            if (educationalInstitutionId != 0 && educationalInstitutionId != null) {
                                educationalInstitutionsSelect.querySelector(`option[value="${educationalInstitutionId}"]`).setAttribute('selected', 'selected');
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                if (nodeSelected != 0 && educationalInstitutionSelected != 0) {
                    getAllEducationalInstitutions(nodeSelected, educationalInstitutionSelected);
                }

                if (nodeSelected != 0 && educationalInstitutionSelected == 0) {
                    getAllEducationalInstitutions(nodeSelected);
                }

                return {
                    getAllNodes: function() {
                        getAllNodes();
                    },
                    onChange: function(e) {
                        nodeId = e.target.value;
                        getAllEducationalInstitutions(nodeId, null);
                    },
                    redirect: function(e) {
                        if (!nodeId && nodeSelected != 0) {
                            nodeId = nodeSelected;
                        }
                        window.location = `/dashboard/nodes/${nodeId}/educational-institutions/${e.target.value}`;
                    }
                }
            })();

            SwitchEducationalInstitution.getAllNodes();
        </script>
    @endpush
@endonce

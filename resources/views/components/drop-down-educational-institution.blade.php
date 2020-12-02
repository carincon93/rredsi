<div class="border-b flex mr-4">
    <div>
        {{-- <x-jet-label for="h_node_id" value="{{ __('node') }}" /> --}}
        <select class="mr-10 bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" id="h_node_id" name="h_node_id" required onchange="SwitchEducationalInstitution.onChange(event)">
            <option value="">Seleccione un nodo</option>
        </select>
    </div>
    <div class="ml-4">
        {{-- <x-jet-label for="h_educational_institution_id" value="{{ __('educational institution') }}" /> --}}
        <select class="mr-10 bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="h_educational_institution_id" name="h_educational_institution_id" required onchange="SwitchEducationalInstitution.redirect(event)">
            <option value="">Seleccione una institución educativa</option>
        </select>
        <x-jet-input-error for="h_educational_institution_id" class="mt-2" />
    </div>
</div>

@once
    @push('scripts')
        <script>
            var SwitchEducationalInstitution = (function() {
                let nodeId                           = null;
                const nodeSelected                   = {{ request()->route('node') != null ? request()->route('node')->id : 0 }};
                const educationalInstitutionSelected = {{ request()->route('educational_institution') != null ? request()->route('educational_institution')->id : 0 }};
                const nodesSelect                    = document.getElementById('h_node_id');

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
                        try {
                            const uri       = `/api/nodes/${node}/educational-institutions/`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.educationalInstitutions.map(function(academicProgram) {
                                educationalInstitutionsSelect.removeAttribute('disabled');
                                let option = `<option value="${academicProgram.id}">${academicProgram.name}</option>`;
                                educationalInstitutionsSelect.innerHTML += option;
                            })

                            if (educationalInstitutionId != 0) {
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
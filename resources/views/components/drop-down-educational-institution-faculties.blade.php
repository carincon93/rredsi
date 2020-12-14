@props(['form'=> "no"])

<div class="mt-1">
    <select class="text-base md:text-xs mr-10 bg-transparent  focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block w-full" id="node_id" name="node_id" required onchange="SwitchFaculties.onChange(event)">
    </select>
</div>

<input class="hidden" id="is_form" value="{{$form}}" >

<div class="mt-1">
    {{-- <p class="mt-4">{{ __('Educational institutions')}} </p> --}}
    <select disabled class="text-base md:text-xs mr-10 bg-transparent  focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block w-full" id="educational_institution_id" name="educational_institution_id" required onchange="SwitchFaculties.onChangeInstitution(event)">
    <option value="">Seleccione un institucion</option>
    </select>
</div>

<div class="mt-1">
    <select class="text-base md:text-xs mr-10 bg-transparent  focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block w-full" disabled id="educational_institutions_faculties_id" name="educational_institutions_faculties_id" required onchange="SwitchFaculties.redirect(event)">
        <option value="">Seleccione una facultad</option>
    </select>
    <x-jet-input-error for="educational_institutions_faculties_id" class="mt-2" />
</div>


 @once
     {{-- @push('scripts') --}}
        <script>
                const nodeSelected                          = {{ request()->route('node') != null ? request()->route('node')->id : 0 }};
                const educationalInstitutionSelected        = {{ request()->route('educational_institution') != null ? request()->route('educational_institution')->id : 0 }};
                const facultySelected                       = {{ request()->route('faculty') != null ? request()->route('faculty')->id : 0 }};

                var SwitchFaculties = (function() {
                    let nodeId                                   = null;

                    getAllNodes = async (nodeSelected) => {
                    const nodesSelect                     = document.getElementById('node_id');
                    nodesSelect.innerHTML = '<option value="">Seleccione un nodo</option>';

                    try {
                            const uri       = `/api/nodes`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.nodes.map(function(node) {
                                let option = `<option  value="${node.id}">${node.state}</option>`;
                                nodesSelect.innerHTML += option;
                            })


                            if (nodeSelected != 0) {
                                nodesSelect.querySelector(`option[value="${nodeSelected}"]`).setAttribute('selected', 'selected');
                                getEducationalInstitutions(nodeSelected,educationalInstitutionSelected);
                            }

                        } catch (error) {
                            console.log(error);
                        }
                    }

                            getEducationalInstitutions = async (node, educationalInstitutionSelected) => {
                        const educationalInstitutionsSelect                     = document.getElementById('educational_institution_id');
                        educationalInstitutionsSelect.innerHTML = '<option value="">Seleccione una institucion</option>';

                        try {
                                const uri       = `/api/nodes/${node}/educational-institutions/`;
                                const response  = await fetch(uri);
                                const result    = await response.json();


                                result.educationalInstitutions.map(function(educationalInstitution) {
                                    educationalInstitutionsSelect.removeAttribute('disabled','disabled');
                                    let option = `<option  value="${educationalInstitution.id}">${educationalInstitution.name}</option>`;
                                    educationalInstitutionsSelect.innerHTML += option;
                                })

                                if (educationalInstitutionSelected != 0) {
                                    educationalInstitutionsSelect.querySelector(`option[value="${educationalInstitutionSelected}"]`).setAttribute('selected', 'selected');
                                }
                            } catch (error) {
                                console.log(error);
                            }
                    }

                        getEducationalInstitutionsFaculties  = async (node, educationalInstitutionId,facultySelected) => {
                        const educationalInstitutionIdSelect   = document.getElementById('educational_institutions_faculties_id');
                        educationalInstitutionIdSelect.innerHTML = '<option value="">Seleccione una facultad</option>';

                        if (node != 0) {
                            try {
                                const uri       = `/api/nodes/${node}/educational-institutions/${educationalInstitutionId}/faculties`;
                                const response  = await fetch(uri);
                                const result    = await response.json();

                                result.educationalInstitutionFaculties.map(function(educationalInstitutionFacultie) {
                                    educationalInstitutionIdSelect.classList.remove('hidden');
                                    educationalInstitutionIdSelect.removeAttribute('disabled','disabled');
                                    let option = `<option value="${educationalInstitutionFacultie.id}">${educationalInstitutionFacultie.name}</option>`;
                                    educationalInstitutionIdSelect.innerHTML += option;
                                })

                                if (facultySelected != 0) {
                                    educationalInstitutionIdSelect.querySelector(`option[value="${facultySelected}"]`).setAttribute('selected', 'selected');
                                }
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    }

                        if (nodeSelected != 0 && educationalInstitutionSelected != 0 && facultySelected != 0) {
                        getEducationalInstitutionsFaculties(nodeSelected, educationalInstitutionSelected, facultySelected);
                        }

                        if (nodeSelected != 0 && educationalInstitutionSelected != 0 && facultySelected == 0) {
                        getEducationalInstitutionsFaculties(nodeSelected, educationalInstitutionSelected);
                        }



                        return {
                        getAllNodes: function() {
                            getAllNodes(nodeSelected);
                        },
                        onChange: function(e) {
                            nodeId = e.target.value;
                            getEducationalInstitutions (nodeId, null);
                        },
                        onChangeInstitution: function(e) {
                            nodeId = document.getElementById('node_id').value;
                            educationalInstitutionId = e.target.value;
                            getEducationalInstitutionsFaculties(nodeId, educationalInstitutionId, null);

                        },
                        redirect: function(e) {
                            var is_form = document.getElementById('is_form');

                            if( is_form.value != "yes")
                            {
                                nodeId = document.getElementById('node_id').value;
                                educationalInstitutionId = document.getElementById('educational_institution_id').value;
                                window.location = `/dashboard/nodes/${nodeId}/educational-institutions/${educationalInstitutionId}/faculties/${e.target.value}`;

                            }


                        }
                    }







            })();

            SwitchFaculties.getAllNodes();


        </script>
     {{-- @endpush --}}
@endonce

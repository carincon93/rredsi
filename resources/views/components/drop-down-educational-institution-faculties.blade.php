@props(['form'=> "no"])

<div class="mt-1">
    <select class="text-xs md:text-xs mr-10 bg-transparent  focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block w-full" id="node_id" name="node_id" required onchange="SwitchFaculties.onChange(event)">
    </select>
</div>

<input class="hidden" id="is_form" value="{{$form}}" >

<div class="static mt-1">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 educational_institution_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label class="mb-4" for="educational_institution_id" value="{{ __('Educational institution') }}" />
    </div>
    <select disabled class="text-xs md:text-xs mr-10 bg-transparent focus:outline-none focus:border-indigo-500 rounded-md border-0 p-3.5 shadow-sm block w-full" id="educational_institution_id" name="educational_institution_id" required onchange="SwitchFaculties.onChangeInstitution(event)">
        <option value="">Seleccione una institución</option>
    </select>
</div>

<div class="static mt-1">
    <div class="flex">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 educational_institution_faculty_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <x-jet-label class="mb-4" for="educational_institution_faculty_id" value="{{ __('Educational institution faculty') }}" />
    </div>
    <select class="text-xs md:text-xs mr-10 bg-transparent form-select rounded-md border-0 p-3.5 shadow-sm block w-full" id="educational_institutions_faculties_id" name="educational_institutions_faculties_id" required onchange="SwitchFaculties.redirect(event)">
        <option value="">Seleccione una institucion para ver las facultades</option>
    </select>
    <x-jet-input-error for="educational_institutions_faculties_id" class="mt-2" />
</div>

@once
    @push('scripts')
        <script>

                        document.addEventListener(
                            "DOMContentLoaded",
                                function() {

                                    window.educationalInstitutionsSpin               = document.querySelector(".educational_institution_id_spin");
                                    window.educationalInstitutionFacultiesSpin       = document.querySelector('.educational_institution_faculty_id_spin');

                        }, false)


                        const nodeSelected                          = {{ request()->route('node') != null ? request()->route('node')->id : 0 }};
                        const educationalInstitutionSelected        = {{ request()->route('educational_institution') != null ? request()->route('educational_institution')->id : 0 }};
                        const facultySelected                       = {{ request()->route('faculty') != null ? request()->route('faculty')->id : 0 }};
                        var SwitchFaculties = (function() {
                            let nodeId  = null;
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
                                educationalInstitutionsSpin.classList.remove('hidden');
                                educationalInstitutionsSpin.classList.add('inline');

                                try {
                                    const uri       = `/api/nodes/${node}/educational-institutions/`;
                                    const response  = await fetch(uri);
                                    const result    = await response.json();
                                    result.educationalInstitutions.map(function(educationalInstitution) {
                                        educationalInstitutionsSelect.removeAttribute('disabled','disabled');
                                        let option = `<option  value="${educationalInstitution.id}">${educationalInstitution.name}</option>`;
                                        educationalInstitutionsSelect.innerHTML += option;
                                    })
                                    if (result.educationalInstitutions.length > 0) {
                                        educationalInstitutionsSpin.classList.remove('inline');
                                        educationalInstitutionsSpin.classList.add('hidden');
                                    }
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
                                    educationalInstitutionFacultiesSpin.classList.remove('hidden');
                                    educationalInstitutionFacultiesSpin.classList.add('inline');
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
                                        if (result.educationalInstitutionFaculties.length > 0) {
                                            educationalInstitutionFacultiesSpin.classList.remove('inline');
                                            educationalInstitutionFacultiesSpin.classList.add('hidden');
                                        }
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
                                    if( is_form.value != 'yes')
                                    {
                                        nodeId = document.getElementById('node_id').value;
                                        educationalInstitutionId = document.getElementById('educational_institution_id').value;
                                        window.location = `/dashboard/nodes/${nodeId}/educational-institutions/${educationalInstitutionId}/faculties/${e.target.value}`;
                                    }
                                }
                            }
                        })();
            document.addEventListener(
                "DOMContentLoaded",
                    function() {
                        setInterval(() => {
                            if(screen.width < 700){
                                const mobil = document.getElementById('educational_institution_id');
                                mobil.setAttribute('onfocus','this.size=6');
                                mobil.setAttribute('onblur','this.size=1');
                                mobil.setAttribute('onchange','SwitchFaculties.onChangeInstitution(event); this.size=1; this.blur()');
                                mobil.classList.remove('form-select');

                            }else if(screen.width > 700){
                                const mobil = document.getElementById('educational_institution_id');
                                mobil.removeAttribute('onfocus','this.size=6');
                                mobil.removeAttribute('onblur','this.size=1');
                                mobil.setAttribute('onchange','SwitchFaculties.onChangeInstitution(event)');
                                mobil.classList.add('form-select');
                            }
                        }, 1000);


                        SwitchFaculties.getAllNodes();
                    }, false
                )
        </script>
    @endpush
@endonce

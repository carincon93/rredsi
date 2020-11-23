@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form" >
            <div class="form-group">
                <label for="name">name</label>
                <small id="nameHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="objectives">objectives</label>
                <small id="objectivesHelp" class="form-text text-muted">Campo requerido</small>
                <textarea
                    name="objectives"
                    class="form-control"
                    id="objectives"
                    rows="3"
                >
                </textarea>
                <span class="invalid-feedback">
                    {{-- {rules.objectives.message ? rules.objectives.message : requestValidation.objectives ? requestValidation.objectives : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="mission">mission</label>
                <small id="missionHelp" class="form-text text-muted">Campo requerido</small>
                <textarea
                    name="mission"
                    class="form-control"
                    id="mission"
                    rows="3"
                >
                </textarea>
                <span class="invalid-feedback">
                    {{-- {rules.mission.message ? rules.mission.message : requestValidation.mission ? requestValidation.mission : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="vision">vision</label>
                <small id="missionHelp" class="form-text text-muted">Campo requerido</small>
                <textarea
                    name="vision"
                    class="form-control"
                    id="vision"
                    rows="3"
                >
                </textarea>
                <span class="invalid-feedback">
                    {{-- {rules.vision.message ? rules.vision.message : requestValidation.vision ? requestValidation.vision : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="achievements">Logros</label>
                <small id="achievementsHelp" class="form-text text-muted">Campo requerido</small>
                <textarea
                    name="achievements"
                    class="form-control"
                    id="achievements"
                    rows="3"
                >
                </textarea>
                <span class="invalid-feedback">
                    {{-- {rules.achievements.message ? rules.achievements.message : requestValidation.achievements ? requestValidation.achievements : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="knowledgeArea">knowledgeArea</label>
                <small id="administrador_idHelp" class="form-text text-muted">Campo requerido</small>
                <select id="knowledge_area"
                    name="knowledge_area"
                    class="form-control"
                    required
                >
                    <option value=''>Selecciones un area de conocimiento</option>

                    @forelse ($knowledgeAreas as $knowledgeArea)
                        <option value={{ $knowledgeArea->id }} >{{ $knowledgeArea->name }} </option>
                    @empty
                        <option value="">No knowledgearea</option>
                    @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.knowledgeArea.message ? rules.knowledgeArea.message : requestValidation.knowledgeArea ? requestValidation.knowledgeArea : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="educationalInstitution">educationalInstitution</label>
                <small id="administrador_idHelp" class="form-text text-muted">Campo requerido</small>
                <select id="knowledge_area"
                    name="knowledge_area"
                    class="form-control"
                    required
                >
                    <option value=''>Selecciones un area de conocimiento</option>

                    @forelse ($educationalInstitutions as $educationalInstitution)
                        <option value={{ $educationalInstitution->id }}>{{ $educationalInstitution->name }}</option>
                    @empty
                        <option value="">No educational Institution</option>
                    @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.educationalInstitution.message ? rules.educationalInstitution.message : requestValidation.educationalInstitution ? requestValidation.educationalInstitution : ''} --}}
                </span>
            </div>



            <div class="form-group">
                <label for="researchGroup">researchGroup</label>
                <small id="researchGroupHelp" class="form-text text-muted">Campo requerido</small>
                <select id="researchGroup"
                    name="researchGroup"
                    class="form-control"
                    required
                >
                    <option value=''>Selecciones un area de conocimiento</option>

                    @forelse ($researchGroups as $researchGroup)
                        <option value={{ $researchGroup->id }} >{{ $researchGroup->name }} </option>
                    @empty
                        <option value="">No educational Institution</option>
                    @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.researchGroup.message ? rules.researchGroup.message : requestValidation.researchGroup ? requestValidation.researchGroup : ''} --}}
                </span>
            </div>

            <button
                class="btn btn-primary"
                type="submit"
                form="form"
            >
                Guardar
            </button>
        </form>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form" >
            <div class="form-group">
                <label for="state">state</label>
                <small id="stateHelp" class="form-text text-muted">Campo requerido</small>
                <select id="state"
                    name="state"
                    class="form-control"
                    required
                    defaultValue={{ $node->state }}

                >
                    <option value='none'>Seleccione un departamento</option>

                    @forelse ($departamentos->state->name as $departamento)
                         <option value={{ $departamento->state->name }} >{{ $departamento->state->name }}</option>
                    @empty
                        <option value="">No departamentos</option>
                    @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.state.message ? rules.state.message : requestValidation.state ? requestValidation.state : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="administrator_id">administrator_id</label>
                <small id="administrador_idHelp" class="form-text text-muted">Campo requerido</small>
                <select id="administrator_id"
                    name="administrator_id"
                    class="form-control "
                    required
                    defaultValue={{ $node->administrator_id }}
                >

                    <option value=''>Seleccione una institución educativa</option>
                    @forelse ($nodeAdmins as $nodeAdmin)
                        <option value={{ $nodeAdmin->user->id }} > {{ $nodeAdmin->user->name }} </option>
                    @empty
                        <option value="">No educational institutions</option>
                    @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''} --}}
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

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form">

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
                    defaultValue=""
                    aria-describedby="nameHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
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

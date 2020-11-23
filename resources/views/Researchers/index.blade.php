@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
      <div class="flex-large">
        <div class="card">
          <div class="card-header">
            <h2>Researchers</h2>
            <a href="/app/researchers/create" class="btn btn-primary">Crear</a>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo electrónico</th>
                <th scope="col">Institución educativa / Grupo de investigación</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($researchers as $researcher)
                    <tr>
                        <td>{{ $researcher->user->name  }}</td>
                        <td>{{ $researcher->user->email }}</td>
                        <td></td>
                        <td class="actions">
                        <div class="actions-wrapper">
                            <a href="/app/researchers/edit/{{ $researcher->id }}"> Editar </a>
                            <a href="/app/researchers/detail/{{ $researcher->id }}"> Detail </a>
                            <button class="btn" type="button" > Eliminar </button>
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                    <td colSpan="4">No researchers</td>
                    </tr>
                @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

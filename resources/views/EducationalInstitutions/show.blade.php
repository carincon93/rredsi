@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $educationalInstitution->name }}</h4>
          <a href="/app/educational-institutions/edit/{{ $educationalInstitution->id }}">
            Editar
          </a>
      </div>
  <hr/>
      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Nit</h5>
              {{ $educationalInstitution->nit }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Dirección</h5>
              {{ $educationalInstitution->address }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Ciudad</h5>
              {{ $educationalInstitution->city }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Telefono</h5>
              {{ $educationalInstitution->phone_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Sitio web</h5>
              {{ $educationalInstitution->website }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Administrador de la institución educativa</h5>
              {{ $educationalInstitution->administrator?->user?->name }}
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

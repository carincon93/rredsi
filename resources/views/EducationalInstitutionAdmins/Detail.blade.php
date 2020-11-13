@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $educationalInstitutionAdmin->user?->name}}</h4>
          <a href=/app/educational-institution-admins/edit/ {{ $educationalInstitutionAdmin->id }}> Editar </a>
      </div>
      <hr/>
      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Correo electrónico</h5>
              {{ $educationalInstitutionAdmin->user?->email}}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Celular</h5>
              {{ $educationalInstitutionAdmin->user?->cellphone_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Documento</h5>
              {{ $educationalInstitutionAdmin->user?->document_type }} {{ $educationalInstitutionAdmin->user?->document_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Institución educativa responsable</h5>
              {{ $educationalInstitutionAdmin->educational_institution?->name }}
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

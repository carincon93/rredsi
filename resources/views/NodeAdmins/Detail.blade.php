@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $nodeAdmin->user->name }}</h4>
          <a href="/app/node-admins/edit/{{ $nodeAdmin->user->id }}">
            Editar
          </a>
      </div>

      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Correo electrónico</h5>
              {{ $nodeAdmin->user->email }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de documento</h5>
              {{ $nodeAdmin->user->document_type }} {{ $nodeAdmin->user->document_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de contacto</h5>
              {{ $nodeAdmin->user->cellphone_number }}
          </div>
        </li>
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Nodo responsable</h5>
              {{ $nodeAdmin->node?->state }} }
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

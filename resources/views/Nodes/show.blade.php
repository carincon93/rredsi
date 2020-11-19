@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $node->state }}</h4>
          <a href="/app/nodes/edit/{{ $node->id }}"> Editar </a>
      </div>
  <hr/>
      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Administrador del nodo</h5>
              {{ $node->administrator?->user->name }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de teléfono del administrador del nodo</h5>
              {{ $node->administrator?->user->cellphone_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Correo electrónico del administrador del nodo</h5>
              {{ $node->administrator?->user->email }}
          </div>
        </li>
      </ul>
    </div>
  </div>



@endsection

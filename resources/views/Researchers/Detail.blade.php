@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{researcher.user.name}</h4>
          <x-jet-nav-link href="/app/researchers/edit/{{$researcher->user->id}}">
            Editar
          </x-jet-nav-link>
      </div>

      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Correo electrónico</h5>
              {{ $researcher->user->email }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de documento</h5>
              {{ $researcher->user->document_type }} {{ $researcher->user->document_number }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de contacto</h5>
              {{ $researcher->user->cellphone_number }}
          </div>
        </li>
        <li class="media">
          <img class="mr-3" src="" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Semilleros de investigación</h5>
              <ul>

                  @forelse ($researcher->user?->research_teams as $researchTeam)
                    <li>{{ $researchTeam->name }}</li>
                  @empty
                     <li>No research teams</li>
                  @endforelse

              </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

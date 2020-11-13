@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $researchTeamAdmin->user->name }}</h4>
          <a href="/app/research-team-admins/edit/{{ $researchTeamAdmin->user->id }}">
            Editar
          </a>
      </div>

      <ul class="list-unstyled">
        <li class="media">
          <img class="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Correo electrónico</h5>
              {{ $researchTeamAdmin->user->email }}
          </div>
        </li>
        <li class="media my-4">
          <img class="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Número de celular</h5>
              {{ $researchTeamAdmin->user->cellphone_number }}
          </div>
        </li>
        <li class="media">
          <img class="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Documento de identidad</h5>
              {{ $researchTeamAdmin->user->document_type }} {{ $researchTeamAdmin->user->document_number }}
          </div>
        </li>
        <li class="media">
          <img class="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div class="media-body">
              <h5 class="mt-0 mb-1">Semillero de investigación responsable</h5>
              {{ $researchTeamAdmin->is_research_team_admin?->name }}
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

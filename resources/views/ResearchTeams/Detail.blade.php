@extends('layouts.app')

@section('content')

<div className="container">
    <div className="card p-4 detail">
      <div className="card-header">
        <h4>{{ $researchTeam->name }}</h4>
        <a href="/app/research-teams/edit/{{ $researchTeam->id }}"">
          Editar
          </a>
      </div>

      <ul className="list-unstyled">
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Nombre del mentor</h5>
            {{ $researchTeam->mentor_name }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Correo electrónico del mentor</h5>
            {{ $researchTeam->mentor_email }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Número celular del mentor</h5>
            {{ $researchTeam->mentor_cellphone }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Objetivo general</h5>
            {{ $researchTeam->overall_objective }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Misión</h5>
            {{ $researchTeam->mission }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Visión</h5>
            {{ $researchTeam->vision }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Proyección regional</h5>
            {{ $researchTeam->regional_projection }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Estrategia de producción de conocimiento</h5>
            {{ $researchTeam->knowledge_production_strategy }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Temáticas de investigación</h5>
            {{ $thematicResearch }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Áreas de conocimiento</h5>
            <ul>
                @forelse ($researchTeam->knowledge_areas? as $knowledge_area)
                    <li>{{ $knowledge_area->name }}</li>
                @empty
                    <li></li>
                @endforelse
            </ul>
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Líneas de investigación</h5>
            <ul>
                @forelse ($researchTeam->research_lines? as $researchLine)
                    <li >{{ $researchLine->name }}</li>
                @empty
                    <li></li>
                @endforelse

            </ul>
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Administrador</h5>
            {{ $researchTeam->administrator?->user->name }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Estudiante lider</h5>
            {{ $researchTeam->student_leader === null? 'Aun no tiene':'Si tiene' }}
          </div>
        </li>
        <li className="media my-4">
          <img className="mr-3" src="images/shapes/circle.png" alt="circle" />
          <div className="media-body">
            <h5 className="mt-0 mb-1">Grupo de investigacion</h5>
            {{ $researchTeam->research_group->name }}
          </div>
        </li>
      </ul>
    </div>
  </div>

@endsection

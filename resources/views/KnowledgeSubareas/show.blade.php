@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $knowledgeSubarea->name }}</h4>
          <a href="/app/knowledge-areas/edit/{{ $knowledgeSubarea->id }}">
            Editar
          </a>
      </div>
  <hr/>
    </div>
  </div>

@endsection

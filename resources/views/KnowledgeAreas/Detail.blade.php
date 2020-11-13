@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
      <div class="card-header">
          <h4>{{ $KnowledgeArea->name }}</h4>
          <a href="/app/knowledge-areas/edit/{{ $KnowledgeArea->id }}">
            Editar
          </a>
      </div>
  <hr/>
    </div>
  </div>

@endsection

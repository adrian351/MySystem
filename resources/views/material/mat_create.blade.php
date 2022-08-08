@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar material'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('material.mat_menu')
    </ul>
  </div>
  <div class="card-body">
    <label for="por_archivo">{{ __('POR ARCHIVO') }}</label>
    <div class="border border-primary rounded p-2">
      <a href="{{ env('PREFIX').'material/FormatoImportMaterial.xlsx' }}" class="btn btn-info float-right" download><i class="fas fa-download"></i> {{ __('Descargar formato') }}</a>
      {!! Form::open(['route' => 'material.importMaterial', 'onsubmit' => 'return checarBotonSubmit("btnsubmitimport")', 'files' => true]) !!}
        @include('material.mat_createFieldsPorArchivo')
      {!! Form::close() !!}
    </div>
    <label for="individual">{{ __('INDIVIDUAL') }}</label>
    <div class="border border-primary rounded p-2">
      {!! Form::open(['route' => 'material.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
        @include('material.mat_createFields')
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
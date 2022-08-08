@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de jobs'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('job.job_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'job.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('job.index'), 'opciones_buscador' => config('opcionesSelect.select_job_index')])
    {!! Form::close() !!}
    @include('job.job.job_table')
    @include('global.paginador.paginador', ['paginar' => $jobs])
  </div>
</div>
@endsection
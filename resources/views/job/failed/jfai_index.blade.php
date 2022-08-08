@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de failed jobs'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('job.job_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'failedJob.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('failedJob.index'), 'opciones_buscador' => config('opcionesSelect.select_failed_job_index')])
    {!! Form::close() !!}
    @include('job.failed.jfai_table')
    @include('global.paginador.paginador', ['paginar' => $failed_jobs])
  </div>
</div>
@endsection
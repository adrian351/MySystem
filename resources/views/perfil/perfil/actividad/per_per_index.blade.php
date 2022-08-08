@extends('perfil.perfil.per_per_index')
@section('contenidoPerfil')
{!! Form::model(Request::all(), ['route' => 'perfil.actividad.index', 'method' => 'GET']) !!}
  @include('global.buscador.buscador', ['ruta_recarga' => route('perfil.actividad.index'), 'opciones_buscador' => config('opcionesSelect.select_perfil_actividad_index')])
{!! Form::close() !!}
@include('perfil.perfil.actividad.per_per_table')
@include('global.paginador.paginador', ['paginar' => $actividades])
@endsection 
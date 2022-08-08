@extends('layouts.private.escritorio.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ $usuario->nom.' '.$usuario->apell }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Lista de quejas y sugerencias').' | '.$usuario->nom)</title>
@include('usuario.show.usu_sho_menu')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['usuario.show.quejaYSugerencia.index', Crypt::encrypt($usuario->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('usuario.show.quejaYSugerencia.index', Crypt::encrypt($usuario->id)), 'opciones_buscador' => config('opcionesSelect.select_cliente_qys_index')])
    {!! Form::close() !!}
    @include('usuario.show.quejaYSugerencia.sho_qsu_table')
    @include('global.paginador.paginador', ['paginar' => $quejas_y_sugerencias])
  </div>
</div>
@endsection
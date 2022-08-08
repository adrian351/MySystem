@extends('layouts.private.escritorio.dashboard')
@section('titulo')
{{--  <div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ $cliente->nom.' '.$cliente->apell }}</h1>
</div>  --}}
<div class="perfil card col-sm-5 m-0">
  <div class="card-body p-2">
    <h1 class="m-0 text-black"> {{ $cliente->nom.' '.$cliente->apell }}</h1>
  </div>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Lista de datos fiscales').' | '.$cliente->nom)</title>
@include('cliente.show.cli_sho_menu')
@can('cliente.edit')
  @include('cliente.show.datoFiscal.sho_dfi_create')
@endcan
<div class="{{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['cliente.show.datoFiscal.index', Crypt::encrypt($cliente->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('cliente.show.datoFiscal.index', Crypt::encrypt($cliente->id)), 'opciones_buscador' => config('opcionesSelect.select_datos_fiscales_index')])
    {!! Form::close() !!}
    @include('cliente.show.datoFiscal.sho_dfi_table')
    @include('global.paginador.paginador', ['paginar' => $datos_fiscales]) 
  </div>
</div>
@endsection
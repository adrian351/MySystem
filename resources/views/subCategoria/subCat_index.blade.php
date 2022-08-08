@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de SubCategorias'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('subCategoria.subCat_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'subCategoria.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('subCategoria.index'), 'opciones_buscador' => config('opcionesSelect.select_subCategoria_index')])
    {!! Form::close() !!}
    @include('subCategoria.subCat_table')
    @include('global.paginador.paginador', ['paginar' => $subCategorias])
  </div>
</div>
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar categoria').' '.$categoria->categoria)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      {{--  @can('armado.show')
        <a href="{{ route('armado.show', Crypt::encrypt($armado->id)) }}" class="text-white">{{ $armado->nom }}</a>
      @else  --}}
        {{ $categoria->categoria}}
      {{--  @endcan  --}}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $categoria->id }}</small>
    </div>
  </div>
</div>
@can('categoria.edit')
  <div class="card card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['categoria.update', Crypt::encrypt($categoria->id)], 'method' => 'patch', 'id' => 'categoriaUpdate']) !!}
        <div class="row">
            <div class="form-group col-sm btn-sm"> 
                <label for="categoria">{{ __('Categoría') }} </label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
                <input type="text" class="form-control" name="categoria"  value="{{ $categoria->categoria }}">
                </div>
            </div>
            <div class="form-group col-sm btn-sm"> 
                <label for="descripcion">{{ __('Descripción') }} </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                    </div>
                    <input type="text" class="form-control" name="descripcion" value="{{ $categoria->descripcion }}">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm" >
            <a href="{{ route('categoria.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
          </div>
          <div class="form-group col-sm btn-sm">
            <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'categoriaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@endsection
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles armado').' '.$etiqueta->etiqueta)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('etiqueta.edit')
        <a href="{{ route('etiqueta.edit', Crypt::encrypt($etiqueta->id)) }}" class="text-white">{{ $etiqueta->etiqueta }}</a>
      @else
        {{ $etiqueta->etiqueta}}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $etiqueta->id }}</small>
    </div>
  </div>
</div>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    <div class="row">
        <div class="form-group col-sm btn-sm"> 
            <label for="etiqueta">{{ __('Etiqueta') }} </label>
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list"></i></span>
            </div>
            <input type="text" class="form-control" name="etiqueta"  value="{{ $etiqueta->etiqueta }}" disabled>
            </div>
        </div>
        <div class="form-group col-sm btn-sm"> 
            <label for="descripcion">{{ __('Descripción') }} </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                </div>
                <input type="text" class="form-control" name="descripcion" value="{{ $etiqueta->descripcion }}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('etiqueta.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection
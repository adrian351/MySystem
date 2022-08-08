@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Consultar precio'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('material.mat_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'material.consultarPrecio', 'method' => 'GET']) !!}
      <div class="border border-primary rounded p-2">
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="modelo_buscado">{{ __('Modelo buscado') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list"></i></span>
              </div>
              {!! Form::select('modelo_buscado', $materiales, null, ['class' => 'form-control select2' . ($errors->has('modelo_buscado') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onchange' => 'this.form.submit()']) !!}
            </div>
            <span class="text-danger">{{ $errors->first('sku') }}</span>
          </div>
        </div>
      </div>
      @if($material != null)
        @include('material.mat_consultarPrecioFields')
      @endif
      @include('layouts.private.plugins.priv_plu_select2')
    {!! Form::close() !!}
  </div>
</div>
@endsection
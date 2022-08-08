@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar Marca'))</title>
<div class="card">
    <div class="card-header p-1">
        <ul class="nav nav-pills">
          @include('marcas.marca_menu')
        </ul>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'marca.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
        <div class="row">
          <div class="form-group col-sm btn-sm"> 
              <label for="marca">{{ __('Marca') }} </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-tag"></i></span>
                </div>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="{{ __('Marca') }}" required>
              </div>
          </div>
          <div class="form-group col-sm btn-sm"> 
              <label for="razon_social">{{ __('Razón Social') }} </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                </div>
                <input type="text" class="form-control" id="razon_social" name="razon_social" aria-describedby="" placeholder="{{ __('Razón Social') }}" required>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-sm btn-sm"> 
                <label for="dominio">{{ __('Dominio') }} </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                  </div>
                  <input type="text" class="form-control" id="dominio" name="dominio" aria-describedby="" placeholder="{{ __('Dominio') }}">
                </div>
            </div>
            <div class="form-group col-sm btn-sm"> 
                <label for="email">{{ __('Email') }} </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="" placeholder="{{ __('Email') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm btn-sm"> 
                <label for="telefono">{{ __('Teléfono') }} </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="" placeholder="{{ __('Teléfono') }}">
                </div>
            </div>
            <div class="form-group col-sm btn-sm"> 
                <label for="whats_app">{{ __('Whats App') }} </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" id="whats_app" name="whats_app" aria-describedby="" placeholder="{{ __('Whats App') }}">
                </div>
            </div>
        </div> 
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="coment">{{ __('Comentarios') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-text-width"></i></span>
              </div>
              <textarea class="form-control" placeholder="{{ __('Comentarios') }}" id="coment" name="coment"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-sm btn-sm">
                <a href="{{ route('marca.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
            </div>
            <div class="form-group col-sm btn-sm">
                <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection

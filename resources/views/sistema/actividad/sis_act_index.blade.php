@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registro de actividades'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'sistema.actividad.index', 'method' => 'GET']) !!}
      <nav class="navbar navbar-expand-lg pt-1">
        <button class="navbar-toggler border rounded" type="button" data-toggle="collapse" data-target="#buscador" aria-controls="buscador" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-search"> {{ __('Buscador') }}</span>
        </button>
        <div class="collapse navbar-collapse" id="buscador">
{{--
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <div class="input-group input-group-sm" style="width: 13em;">
                {{ __('Mostrar') }} 
                &nbsp{!! Form::select('paginador', ['15' => '15', '30' => '30', '50' => '50'], empty($num_pag) ? __('15') :  $num_pag, ['class' => 'form-control btn-sm w-25', 'onchange' => 'this.form.submit()']) !!}&nbsp 
                {{ __('registros') }}.
                <span class="text-danger">{{ $errors->first('paginador') }}</span>
              </div>
            </li>
          </ul>
 --}}
          <div class="form-inline my-2 my-lg-0">
            <div class="input-group input-group-sm">
              {!! Form::select('opcion_buscador_1', config('opcionesSelect.select_sistema_actividad_index'), null, ['class' => 'form-control float-right']) !!}
              {!! Form::text('buscador_1', null, ['class' => 'form-control float-right my-2 my-sm-0 mr-3', 'placeholder' =>  __('Buscador'), 'title' => __('Enter para buscar')]) !!}
            </div>
          </div>
          <div class="form-inline my-2 my-lg-0">
            <div class="input-group input-group-sm">
              {!! Form::select('opcion_buscador_2', config('opcionesSelect.select_sistema_actividad_index'), null, ['class' => 'form-control float-right']) !!}
              {!! Form::text('buscador_2', null, ['class' => 'form-control float-right my-2 my-sm-0 mr-3', 'placeholder' =>  __('Buscador'), 'title' => __('Enter para buscar')]) !!}
            </div>
          </div>
          <div class="form-inline my-2 my-lg-0">
            <div class="input-group input-group-sm">
              {!! Form::select('opcion_buscador_3', config('opcionesSelect.select_sistema_actividad_index'), null, ['class' => 'form-control float-right']) !!}
              {!! Form::text('buscador_3', null, ['class' => 'form-control float-right', 'placeholder' =>  __('Buscador'), 'title' => __('Enter para buscar')]) !!}
              <div class="input-group-append">
                <a href="{{ route('sistema.actividad.index') }}" class="btn btn-default" title="{{ __('Mostrar todos los registros') }}"><i class="fas fa-spinner"></i></a>
              </div>
            </div>
            <span class="pantallaMax985px">
              <button type="submit" class="btn btn-outline-success btn-sm my-2 my-sm-0 ml-3"><i class="fas fa-search"></i> {{ __('Buscar') }}</button>
            </span>
          </div>
        </div>
      </nav>
      {!! Form::close() !!}
    @include('sistema.actividad.sis_act_table')
    @include('global.paginador.paginador', ['paginar' => $actividades])
  </div>
</div>
@endsection
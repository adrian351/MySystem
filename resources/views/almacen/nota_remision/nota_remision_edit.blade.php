@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar nota').' '.$nota->id)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      {{ $nota->id }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $nota->id }}</small>
    </div>
  </div>
</div>
@can('almacen.nota.edit')
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['almacen.nota.update', Crypt::encrypt($nota->id)], 'method' => 'patch', 'id' => 'notaUpdate', 'files' => true]) !!}

      <div class="row">
        <div class="form-group col-sm">
          <label for="producto" class="col-sm col-form-label">{{ __('Producto') }} </label>
          <div class="input-group">
            {!! Form::text('producto', $nota->product, ['class' => 'form-control', 'placeholder' => __('Producto'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
        <div class="form-group col-sm">
          <label for="cant_enviada" class="col-sm col-form-label">{{ __('Cantidad enviada') }} </label>
          <div class="input-group">
            {!! Form::text('cant_enviada', $nota->cant_envio, ['class' => 'form-control', 'placeholder' => __('Cantidad enviada'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
      </div> 

      <div class="row">
        <div class="form-group col-sm">
          <label for="per_recibe" class="col-sm col-form-label">{{ __('Persona que recibe') }} </label>
          <div class="input-group">
            {!! Form::text('per_recibe', $nota->per_recibe, ['class' => 'form-control' . ($errors->has('per_recibe') ? ' is-invalid' : ''), 'placeholder' => __('Persona que aprueba')]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('per_aprueba') }}</span>
        </div>
        <div class="form-group col-sm">
          <label for="cant_recibida" class="col-sm col-form-label">{{ __('Cantidad recibida') }} </label>
          <div class="input-group">
            {!! Form::number('cant_recibida', $nota->cant_recibida, ['class' => 'form-control' . ($errors->has('cant_recibida') ? ' is-invalid' : ''), 'placeholder' => __('Cantidad recibida'), 'required' => 'true']) !!}
          </div>
          <span class="text-danger">{{ $errors->first('cant_recibida') }}</span>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm" >
          <a href="{{ route('almacen.nota.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'notaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@endsection
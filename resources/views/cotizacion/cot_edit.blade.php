@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar cotización').' '.$cotizacion->cliente->email_registro )</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <a href="{{ route('cotizacion.index') }}" class="text-white ml-3" title="Regresar"><i class="fas fa-arrow-left"></i></a>
      &nbsp;&nbsp;&nbsp;
        <strong>{{ __('Editar cotización') }}: </strong>
        &nbsp;&nbsp;&nbsp;{{ $cotizacion->serie }} 
    
      @can('cotizacion.show')
        <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" class="text-white float-right"> {{ __('Cliente: ') }}&nbsp;&nbsp;&nbsp;{{ $cotizacion->cliente->email_registro }}</a>
      @else
      <span class="text-white float-right">{{ __('Cliente: ') }}&nbsp;&nbsp;&nbsp; {{ $cotizacion->cliente->email_registro  }}</span>
      @endcan
    </h5>
  </div>
</div>
<center>
<div class="card w-50 p-1">
    @canany(['cotizacion.index', 'cotizacion.show', 'cotizacion.edit'])
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
      <a class="btn btn-outline-dark" href="{{ route('cotizacion.generarCotizacion', Crypt::encrypt($cotizacion->id)) }}" target="_blank"><i class="fas fa-file-pdf"></i> {{ __('Generar PDF') }}</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <form action="{{ route('cotizacion.clonar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionClonar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="far fa-clone"></i> Clonar', ['type' => 'submit', 'class' => 'btn btn-outline-info', 'id' => "btnClo$cotizacion->id", 'onclick' => "return check('btnClo$cotizacion->id', 'cotizacionClonar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres clonar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <form action="{{ route('cotizacion.aprobar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionAprobar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="fas fa-check"></i> Aprobar', ['type' => 'submit', 'class' => 'btn btn-outline-success', 'id' => "btnApro$cotizacion->id", 'onclick' => "return check('btnApro$cotizacion->id', 'cotizacionAprobar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres aprobar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <form action="{{ route('cotizacion.cancelar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionCancelar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="fas fa-ban"></i> Cancelar', ['type' => 'submit', 'class' => 'btn btn-outline-danger', 'id' => "btnCan$cotizacion->id", 'onclick' => "return check('btnCan$cotizacion->id', 'cotizacionCancelar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres cancelar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
  
    </div>
    @endcanany
    {{--  <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('cotizacion.show')
        <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" class="text-white">{{ $cotizacion->cliente->email_registro }}</a>
      @else
        {{ $cotizacion->cliente->email_registro  }}
      @endcan
    </h5>  --}}
 
</div>
</center>
@include('cotizacion.armado_cotizacion.cot_arm_index')
<div class="card {{ config('app.color_bg_secundario') }} card-outline card-tabs position-relative bg-white">
  {{--  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $cotizacion->serie }}</small>
    </div>
  </div>  --}}
  <div class="card-body">
    <div id="cot">
      <div class="card">
        <div class="card-header p-0" id="headingThree">
          <h4 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
             <span style="font-size: 15px;"> <i class="fas fa-info-circle"></i>  {{ __('Información del registro') }}</span>
            </button>
          </h4>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#cot">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-sm btn-sm">
                <label for="serie">{{ __('Serie') }}</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  {!! Form::select('serie', [$cotizacion->serie => $cotizacion->serie], $cotizacion->serie, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
                </div>
              </div>
              @include('cotizacion.cot_showFields.validez')
            </div>
            <div class="row">
              <div class="form-group col-sm btn-sm">
                <label for="correo_del_cliente">{{ __('Correo del cliente') }}</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  {!! Form::select('correo_del_cliente', [$cotizacion->cliente->id => $cotizacion->cliente->email_registro], $cotizacion->user_id, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled']) !!}
                </div>
              </div>
              @include('cotizacion.cot_showFields.estatus')
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::open(['route' => ['cotizacion.update', Crypt::encrypt($cotizacion->id)], 'method' => 'patch', 'id' => 'cotizacionUpdate']) !!}
      @include('cotizacion.cot_editFields')
    {!! Form::close() !!}
  </div>
</div>
@include('cotizacion.promociones.cot_index')
@include('layouts.private.plugins.priv_plu_select2')
@endsection
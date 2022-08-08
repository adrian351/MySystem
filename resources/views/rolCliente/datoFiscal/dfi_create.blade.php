@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar dato fiscal'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.datoFiscal.dfi_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'rolCliente.datoFiscal.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      <label for="redes_sociales">{{ __('IMPORTANTE') }}</label>
      <div class="border border-primary rounded p-2">
        <div class="row">
          <div class="form-group col-sm btn-sm">
              <strong>
                {{ __('Después de registra tus datos fiscales recuerda solicitar tu factura') }}.
              </strong>
          </div>
        </div>
      </div>
      @include('rolCliente.datoFiscal.dfi_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('rolCliente.datoFiscal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
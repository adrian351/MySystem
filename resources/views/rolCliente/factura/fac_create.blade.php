@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Solicitar factura'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.factura.fac_menu')
    </ul>
  </div>
  <div class="card-body">
    {{--  <label for="redes_sociales">{{ __('IMPORTANTE') }}</label>  --}}
{{--  <div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
        {{ __('Para cualquier duda o aclaración de tu factura comunicarse al teléfono: (0155) 7159 6103 ext. 1002. NOTA: Si no mandas tus datos de facturación antes del 28 del mes en curso se dará por entendido que no vas a requerir factura y no te la podremos generar en fecha posterior.') }}<br>
        <strong>
          {{ __('Tiempo de emisión 72 hrs') }}.<br>
        </strong>
    </div>
  </div>
</div>  --}}
  <div id="fac">
    <div class="card">
      <div class="card-header p-0" id="headingFac">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFac" aria-expanded="true" aria-controls="collapseFac">
            <b>{{ __('IMPORTANTE') }}</b>
          </button>
        </h5>
      </div>
      <div id="collapseFac" class="collapse" aria-labelledby="headingFac" data-parent="#fac">
        <div class="card-body">
          {{ __('Para cualquier duda o aclaración de tu factura comunicarse al teléfono: (0155) 7159 6103 ext. 1002. NOTA: Si no mandas tus datos de facturación antes del 28 del mes en curso se dará por entendido que no vas a requerir factura y no te la podremos generar en fecha posterior.') 
          }}<br>
          <strong>
            {{ __('Tiempo de emisión 72 hrs') }}.<br>
          </strong>
        </div>
      </div>
    </div>
  </div>

    {!! Form::open(['route' => 'rolCliente.factura.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('rolCliente.factura.fac_createFields')<br/>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-success w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Solicitar') }}</button>
        </div>
        <div class="form-group col-sm btn-sm">
          <center><a href="{{ route('rolCliente.factura.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
        </div>
        
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
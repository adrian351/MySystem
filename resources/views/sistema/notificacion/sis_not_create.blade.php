@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Enviar notificación'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    @canany(['sistema.notificacion.create'])
      @if(Request::route()->getName() == 'sistema.notificacion.create')
        <div style="float: right;">
          <form method="post" action="{{ route('sistema.notificacion.eliminarFicherosNotificacion') }}" id="sistemaNotificacionEliminarFicherosNotificacion">
            @method('GET')@csrf
            {!! Form::button('<i class="far fa-trash-alt"></i> ' . __('Eliminar ficheros'), ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btnsubelim", 'onclick' => "return check('btnsubelim', 'sistemaNotificacionEliminarFicherosNotificacion', '¡Alerta!', '¡Se eliminaran todos los ficheros!', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
          </form>
        </div>
      @endif
    @endcanany
    {!! Form::open(['route' => 'sistema.notificacion.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('sistema.notificacion.sis_not_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection
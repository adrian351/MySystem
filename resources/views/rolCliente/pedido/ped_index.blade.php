@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pedidos'))</title>
<div class="shadow-lg p-2 mb-3 bg-body rounded bg-info ">
  <center>
    <h5>
      <strong>{{ __('Pedidos') }}</strong> 
    </h5>
  </center>
</div>

<div class="card alert" style="background: rgba(142, 144, 148, 0.2)">
  <div class="card-body p-1">
   <strong> 
    <p class="text"><i class="icon fas fa-info"></i>{{ __('IMPORTANTE ') }}</p>
      <li>
        {{ __('El pedido no esta actualizado en tiempo real, favor de comunicarse a CYA') }}.
      </li>
      <li>
        {{ __('Para entregas fueras de la ciudad de México hay un retraso de 5 días hábiles por causa de la pandemia. Gracias por su comprensión') }}
      </li>
    </strong>
  </div>
</div>

<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.pedido.index', 'method' => 'GET']) !!}
        @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.pedido.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_pedido_index')])
    {!! Form::close() !!}
    @include('rolCliente.pedido.ped_table')
    
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection

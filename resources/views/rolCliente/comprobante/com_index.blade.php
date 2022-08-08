@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de comprobantes'))</title>
  <div class="shadow-lg p-2 mb-3 bg-body rounded bg-info ">
    <center>
      <h5>
        <strong>{{ __('Comprobantes de Salida/Entrega') }}</strong> 
      </h5>
    </center>
  </div>
    <div class="card">
      <div class="card-body">
      {!! Form::model(Request::all(), ['route' => 'rolCliente.comprobante.index', 'method' => 'GET']) !!}
          {{-- @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.comprobante.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_pedido_index')]) --}}
          @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('rolCliente.comprobante.index'), 'opciones_buscador' => config('opcionesSelect.select_comprobante_index')])
      {!! Form::close() !!}
      @include('rolCliente.comprobante.com_table')
      @include('global.paginador.paginador', ['paginar' => $pedidos])
    </div>
  </div>
@endsection

@section('css')
<style>
  .i{
    text-align: center;
    color: black;
    border-radius: 100px;
    background:rgb(255, 255, 255);
    box-shadow: inset 4px 4px 6px -1px rgba(209, 208, 208, 0.541),
                inset -4px -4px 6px -1px rgb(255, 255, 255),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }
</style>
  
@endsection

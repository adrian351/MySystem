@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo producción').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->lid_de_ped_produc) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccionHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido producción') }}: </strong>
      @can('produccion.pedidoActivo.show')
        <a href="{{ route('produccion.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('produccion.pedidoActivo.edit')
    <div class="col-md-5">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['produccion.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'produccionPedidoActivoUpdate']) !!}
                @include('produccion.pedido.pedido_activo.pedAct_editFields')
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  
  @if (sizeof($pedido->unificar) != 0)
    @can('produccion.pedidoActivo.edit')
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
    @endcan
    @else 
      @include('produccion.pedido.pedido_activo.ped_dir_tar')
  @endif  
</div>

 <div class="row">
  <div class="col-md">
    @if (sizeof($pedido->unificar) != 0)
      @include('produccion.pedido.pedido_activo.ped_dir_tar')
        @else
          @include('produccion.pedido.pedido_activo.armado_activo.armAct_index')
    @endif
  </div>

  @if (sizeof($pedido->archivos) != 0)
    <div class="col-sm-2">
      <div class="card">
        <div class="card-header p-1 border-bottom bg-dark">
          <h5 align="center">{{ __('Archivos') }}</h5> 
        </div>
        <div class="card-body">
          @foreach ($pedido->archivos as $arch) 
            <a href="{{ $arch->arc_rut.$arch->arc_nom }}" class="m-0">
              <div class="card p-1" title="Ver">
                <center>{{ $arch->nom_visual }}</center>
              </div>
            </a>  
          @endforeach 
        </div>
      </div>
    </div>
  @endif
</div>
  @if (sizeof($pedido->unificar) != 0)
      @include('produccion.pedido.pedido_activo.armado_activo.armAct_index')
  @endif
  
@endsection


@section('css')
<style>
  .imagen{;
    font-size: 20px;
    color: black;
    border: 1px solid rgba(0,0,0,0.01);
  }

</style>
@endsection
{{--  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.imagen')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.created')  --}}
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatusCliente')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.codigo')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.gama')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.cantidad')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.tipo')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.nombreDeArmado')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.sku')
</div>
{{--  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.productosArmado')  --}}

<div id="producto">
  <div class="card">
      <h5 class="mb-0 p-1">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePro" aria-expanded="false" aria-controls="collapsePro">
          <i class="fas fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('PRODUCTOS DEL ARMADO') }}</b>
        </button>
      </h5>
    <div id="collapsePro" class="collapse"  data-parent="#producto">
      <div class="card-body">
        <div class="row">
          <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;">
            <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
              <thead>
                <tr >
                  <th>{{ __('NOMBRE') }}</th>
                </tr>
              </thead>
              <tbody> 
                @foreach($productos as $producto)
                  <tr>
                    <td>
                      {{ $producto->cant }} -
                      {{ $producto->produc }}
                      @foreach($producto->sustitutos as $sustituto)
                        <div class="input-group text-muted ml-4">
                          {{ $sustituto->cant }} -
                          {{ $sustituto->produc }}
                        </div>
                      @endforeach
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.medidas')
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.comentariosCliente')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('rolCliente.pedido.show', Crypt::encrypt($pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar al pedido') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection
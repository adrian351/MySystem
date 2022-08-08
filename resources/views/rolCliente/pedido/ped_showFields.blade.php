<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
        {!! Form::text('created_at', $pedido->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  @if ($pedido->se_pued_entreg_ant != null)
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.sePuedeEntregarAntes')
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cuantosDiasAntes')

    @else
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccionCliente')
  @endif
  
</div>
@if ($pedido->se_pued_entreg_ant != null)
  <div class="row">
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccionCliente')
  </div>
@endif
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosCliente')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('rolCliente.pedido.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection
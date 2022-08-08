<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
	<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
		@if(sizeof($envios) == 0)
			@include('layouts.private.busquedaSinResultados')
		@else 
			<thead>
				<tr>
          <th>{{ __('RUTA') }}</th>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.bodega')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.fechaDeEntrega')
          <th>{{ __('TAMAÑO') }}</th>
          <th>{{ __('PESO') }}</th>
          <th>{{ __('ALTO') }}</th>
          <th>{{ __('ANCHO') }}</th>
          <th>{{ __('LARGO') }}</th>
          <th>{{ __('RACK') }}</th>
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
					@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
          <th>{{ __('TELEFONO FIJO') }}</th>
          <th>{{ __('EXTENSION') }}</th>
          <th>{{ __('TELEFONO MOVIL') }}</th>
          <th>{{ __('CALLE') }}</th>
          <th>{{ __('NO. EXTERIOR') }}</th>
          <th>{{ __('NO. INTERIOR') }}</th>
          <th>{{ __('PAIS') }}</th>
          <th>{{ __('CIUDAD') }}</th>
          <th>{{ __('COLONIA') }}</th>
          <th>{{ __('DELEGACION O MUNICIPIO') }}</th>
          <th>{{ __('C.P.') }}</th>
          <th>{{ __('REFERENCIAS') }}</th>
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntregaLogistica')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
				</tr>
			</thead>
			<tbody> 
				@foreach($envios as $direccion)
					<tr>
            <td>{{ $direccion->rut }}</td>
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.bodega', ['pedido' => $direccion->armado->pedido])
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.fechaDeEntrega')
            <td>{{ $direccion->armado->tam }}</td>
            <td>{{ $direccion->armado->pes }}</td>
            <td>{{ $direccion->armado->alto }}</td>
            <td>{{ $direccion->armado->ancho }}</td>
            <td>{{ $direccion->armado->largo }}</td>
            <td>{{ $direccion->armado->ubic_rack }}</td>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => false])
						@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
            <td>{{ $direccion->lad_fij.$direccion->tel_fij }}</td>
            <td>{{ $direccion->ext }}</td>
            <td>{{ $direccion->lad_mov.$direccion->tel_mov }}</td>
            <td>{{ $direccion->calle }}</td>
            <td>{{ $direccion->no_ext }}</td>
            <td>{{ $direccion->no_int }}</td>
            <td>{{ $direccion->pais }}</td>
            <td>{{ $direccion->ciudad }}</td>
            <td>{{ $direccion->col }}</td>
            <td>{{ $direccion->del_o_munic }}</td>
            <td>{{ $direccion->cod_post }}</td>
            <td>{{ $direccion->ref_zon_de_entreg }}</td>
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntregaLogistica')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
					</tr>
				@endforeach
			</tbody>
		@endif
	</table>
</div>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($direcciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($direcciones as $direccion)
          <tr title="{{ $direccion->est }}">
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => false])
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
            <td title="Ver otros costos: {{ $direccion->est }}">
            <a href="{{ route('costoDeEnvio.opcionesCostos.direccion', Crypt::encrypt($direccion->id)) }}" class='btn btn-info btn-sm' target="_blank">{{ _('Ver otras opciones de costos para esta dirección') }}</a>
            </td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
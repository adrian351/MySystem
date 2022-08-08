<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($sustitutos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          <th>{{ __('CANTIDAD') }}</th>
          <th>{{ __('PRODUCTO') }}</th>
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($sustitutos as $sustituto)
          <tr title="{{ $sustituto->sku }}">
            <td>{{ $sustituto->cant }}</td>
            <td>{{ $sustituto->produc }}</td>
            <td width="1rem" title="Eliminar: {{ $sustituto->sku }}">
              <form method="post" action="{{ route('almacen.pedidoActivo.armado.sistituto.destroy', Crypt::encrypt($sustituto->id)) }}" id="almacenPedidoActivoArmadoSistitutoDestroy{{ $sustituto->id }}">
                @method('DELETE')@csrf
                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$sustituto->id", 'onclick' => "return check('btnsub$sustituto->id', 'almacenPedidoActivoArmadoSistitutoDestroy$sustituto->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $sustituto->sku ($sustituto->produc) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
              </form>
            </td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div> 
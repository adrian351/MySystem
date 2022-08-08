<div class="card-body table-responsive p-0" id="div-tabla-scrollbar4" style="height: 20em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($archivos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <tbody> 
        @foreach($archivos as $archivo)
          <tr title="{{ $archivo->nom_visual }}">
            <td>
              <a href="{{ $archivo->arc_rut.$archivo->arc_nom }}" download target="_blank">{{ $archivo->nom_visual }}</a>
            </td>
            @if(Request::route()->getName() == 'venta.pedidoActivo.edit')
              @include('venta.pedido.pedido_activo.archivo.arc_tableOpciones')
            @endif
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
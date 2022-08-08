<div class="card-body table-responsive p-0  mailbox-messages" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-sm">
    @if(sizeof($archivos_generados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <tbody> 
        @foreach($archivos_generados as $archivo_generado)
          <tr title="" style="{{ $archivo_generado->read_at != null ? 'background:#ECECEC;' : '' }}">
            <td>
              <a href="{{ $archivo_generado->data['arch_rut'].$archivo_generado->data['arch_nom'] }}" class="dropdown-item">
                @if($archivo_generado->data['tip'] == 'XLSX')
                  <i class="fas fa-file-excel"></i> 
                @elseif($archivo_generado->data['tip'] == 'PDF')
                  <i class="fas fa-file-pdf"></i> 
                @endif
                {{ $archivo_generado->data['arch_nom_abrev'] }}<br> 
              </a>
            </td>
            <td>
              <span class="text-muted text-sm pantallaMax985px">{{ $archivo_generado->created_at }} ({{ $archivo_generado->created_at->diffForHumans() }})</span>
            </td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
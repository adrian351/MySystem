<div class="card-body table-responsive p-0  mailbox-messages" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-sm">
    @if(sizeof($notificaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <tbody> 
        @foreach($notificaciones as $notificacion)
          <tr title="" style="{{ $notificacion->read_at != null ? 'background:#ECECEC;' : '' }}">
            <td width="1rem">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="Checkbox{{ $notificacion->id }}" onClick='return seleccionar("{{ $notificacion->id }}")'>
                <label for="Checkbox{{ $notificacion->id }}" class="custom-control-label"></label>
              </div>
            </td>
            <td>
              <a href="{{ route($notificacion->data['rut'], array($notificacion->data['id_reg'], Crypt::encrypt($notificacion->id))) }}">
                {{ $notificacion->data['asunto'] }}
              </a>
            </td>
            <td>
              <a href="{{ route($notificacion->data['rut'], array($notificacion->data['id_reg'], Crypt::encrypt($notificacion->id))) }}">
                <span class="text-muted text-sm pantallaMax985px">{{ $notificacion->created_at }} ({{ $notificacion->created_at->diffForHumans() }})</span>
              </a>
            </td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
@section('js')
<script>
  var ids_selec = [];
  function seleccionar(ids) {
    if(ids_selec.includes(ids)) { // Verifica si el elemento existe en el array
      var indice = ids_selec.indexOf(ids); // Obtiene la posición (índex) del elemento seleccionado
      ids_selec.splice(indice, 1); // Elimina 1 elemento dentro del índex seleccionado
    } else {
      ids_selec.push(ids); // Agrega el elemento seleccionado al array 
    }
    inpV = document.getElementById("marcarComoVisto");
    inpNV = document.getElementById("marcarComoNoVisto");
    if(ids_selec.length > 0) {
      inpV.style.display = "";
      inpNV.style.display = "";
    } else {
      inpV.style.display = "none";
      inpNV.style.display = "none";
    }
  }
  function marcarComoVisto() {
    document.getElementById('marcarComoVisto').disabled = true; // Deshabilita el boton con el id espesificado
    document.getElementById('marcarComoNoVisto').disabled = true; // Deshabilita el boton con el id espesificado
    axios.post('/perfil/notificacion/marcar-como-visto', { // Manda los Id seleccionados al API
      ids_seleccionados: ids_selec
    }).then(res => {
      location.reload();
    }).catch(error => {
      Swal.fire({
        icon: 'error',
        title: 'Algo salio mal',
        text: 'Error: ' + error.response.data.message,
      })
    });
  }
  function marcarComoNoVisto() {
    document.getElementById('marcarComoVisto').disabled = true; // Deshabilita el boton con el id espesificado
    document.getElementById('marcarComoNoVisto').disabled = true; // Deshabilita el boton con el id espesificado
    axios.post('/perfil/notificacion/marcar-como-no-visto', { // Manda los Id seleccionados al API
        ids_seleccionados: ids_selec
      }).then(res => {
        location.reload();
      }).catch(error => {
        Swal.fire({
          icon: 'error',
          title: 'Algo salio mal',
          text: 'Error: ' + error.response.data.message,
        })
      });
  }
</script>
@endsection
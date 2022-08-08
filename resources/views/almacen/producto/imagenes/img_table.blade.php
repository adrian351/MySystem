<div class="card-body table-responsive p-0" id="div-tabla-scrollbar">
  <table class="table table-sm">
    @if(sizeof($imagenes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <tbody> 
        @foreach($imagenes as $imagen)
          <td title="{{ __('Fecha de registro') }}: {{ $imagen->created_at }}, {{ __('Registrado por') }}: {{ $imagen->created_at_reg }}, {{ __('Nombre') }}: {{ $imagen->img_nom }}">
            <div class="card" style="width: 12rem;">
              @if(Request::route()->getName() == 'almacen.producto.edit')
                <form method="post" action="{{ route('almacen.producto.imagen.destroy', Crypt::encrypt($imagen->id)) }}" id="almacenProductoImagenDestroy{{ $imagen->id }}" class="col-sm-12 p-0 bg-danger">
                  @method('DELETE')@csrf
                  {!! Form::button(__('Eliminar'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm w-100 p-0', 'id' => "btnsub$imagen->id", 'onclick' => "return check('btnsub$imagen->id', 'almacenProductoImagenDestroy$imagen->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $imagen->id ($imagen->img_nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                </form>
              @endif
              <img src="{{ $imagen->img_rut.$imagen->img_nom }}" class="card-img-top" alt="{{ $imagen->img_nom }}">
              <div class="card-body">
                <p class="card-text text-muted text-sm">
                  <a href="{{ $imagen->img_rut.$imagen->img_nom }}" target="__blank">
                    <center>{{ __('Ver Imágen') }}</center>
                </p>
              </div>
            </div>
          </td>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
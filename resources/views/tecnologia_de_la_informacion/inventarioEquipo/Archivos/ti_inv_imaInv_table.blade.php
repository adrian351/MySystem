<div class="card-body table-responsive p-0" id="div-tabla-scrollbar">
  <table class="table table-sm">
    @if(sizeof($archivos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <tbody>
        @foreach ($archivos as $archivo)
          <td title="{{ __('Fecha de registro') }}: {{ $archivo->created_at }}, {{ __('Registrado por') }}: {{ $archivo->created_at }}, {{ __('Nombre') }}: {{ $archivo->arc_nom }}">
            <div class="card" style="width: 12rem;">
              @if (Request::route()->getName() == 'inventario.edit')
                <form method="post" action="{{ route('inventario.archivo.destroy', Crypt::encrypt($archivo->id)) }}" id="inventarioArchivoDestroy{{ $archivo->id }}" class="col-sm-12 p-0 bg-danger">
                  @method('DELETE')@csrf
                    {!! Form::button(__('Eliminar'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm w-100 p-0', 'id' => "btnsub$archivo->id", 'onclick' => "return check('btnsub$archivo->id', 'inventarioArchivoDestroy$archivo->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $archivo->id ($archivo->arc_nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                </form>
              @endif
                <img src="{{ $archivo->arc_rut.$archivo->arc_nom }}" class="card-img-top" alt="{{ $archivo->arc_nom }}">
                  <div class="card-body">
                    <p class="card-text text-muted text-sm">
                      <a href="{{ $archivo->arc_rut.$archivo->arc_nom }}" download>{{ $archivo->arc_nom }}</a>
                    </p>
                  </div>
            </div>
          </td>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar">
  <table class="table table-sm">
    @if(sizeof($imagenes) == 0)
      @include('layouts.private.busquedaSinResultados')
      
    @else 
      <tbody> 
        {{--  @if (count($imagenes)>= 3)  --}}
          @foreach($imagenes as $imagen)
            <td title="{{ __('Fecha de registro') }}: {{ $imagen->created_at }}, {{ __('Registrado por') }}: {{ $imagen->created_at_img }}, {{ __('Nombre') }}: {{ $imagen->img_nom }}">
              <div class="card" style="width: 12rem;">
                <img src="{{ $imagen->img_rut.$imagen->img_nom }}" class="card-img-top" alt="{{ $imagen->img_nom }}">
                <div class="card-body">
                  <p class="card-text text-muted text-sm">
                    <a href="{{ $imagen->img_rut.$imagen->img_nom }}" target="__blank" class="btn btn-info btn-sm w-100 p-0">{{ __('Visualizar')}}</a>
                  </p>
                  @if(Request::route()->getName() == 'armado.edit' OR Request::route()->getName() == 'armado.clon.edit')
                    <form method="post" action="{{ route('armado.imagen.destroy', Crypt::encrypt($imagen->id)) }}" id="armadoImagenDestroy{{ $imagen->id }}">
                      @method('DELETE')@csrf
                      {!! Form::button(__('Eliminar'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm w-100 p-0', 'id' => "btnsub$imagen->id", 'onclick' => "return check('btnsub$imagen->id', 'armadoImagenDestroy$imagen->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $imagen->id ($imagen->img_nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                    </form>
                  @endif
                </div>
              </div>
            </td>
          @endforeach
            {{--  @elseif(count($imagenes) <=)
            @else
              <strong>
                <p><i class="fas fa-check"></i> Carga al menos 3 imagenes para que sean mostradas</p>
                <hr>
              </strong>
        @endif  --}}
      </tbody>
    @endif
  </table>
</div>
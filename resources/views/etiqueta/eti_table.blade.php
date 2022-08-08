<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($etiquetas) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else
        <thead>
          <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('ETIQUETA') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th colspan="3">&nbsp</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($etiquetas as $etiqueta)
            <tr title={{ $etiqueta->id }}>
              <td>{{ $etiqueta->id }}</td>
              {{--  <td>{{$etiqueta->etiqueta }}</td>  --}}
              <td>
                @can('etiqueta.show')
                    <a href="{{ route('etiqueta.show', Crypt::encrypt($etiqueta->id)) }}" title="Detalles: {{ $etiqueta->etiqueta }}">{{ $etiqueta->etiqueta }}</a>
                  @else
                    {{ $etiqueta->etiqueta  }}
                @endcan
              </td>
              <td>{{ $etiqueta->descripcion }}</td>
              <td width="1rem" title="Editar: {{ $etiqueta->etiqueta }}">
                  @can('etiqueta.edit')
                    <a href="{{ route('etiqueta.edit', Crypt::encrypt($etiqueta->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
                  @endcan
              </td>
              <td width="1rem" title="Eliminar: {{ $etiqueta->etiqueta }}">
                  @can('etiqueta.destroy')
                    <form method="post" action="{{ route('etiqueta.destroy', Crypt::encrypt($etiqueta->id)) }}" id="etiquetaDestroy{{ $etiqueta->id }}">
                      @method('DELETE')@csrf
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$etiqueta->id", 'onclick' => "return check('btnsub$etiqueta->id', 'etiquetaDestroy$etiqueta->id', '¡Alerta!', 'Eliminarás este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $etiqueta->id ($etiqueta->etiqueta) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                    </form>
                  @endcan
              </td>
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
</div>
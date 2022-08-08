<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($categorias) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else
        <thead>
          <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('CATEGORIA') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th colspan="3">&nbsp</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($categorias as $categoria)
            <tr title={{ $categoria->id }}>
              <td>{{ $categoria->id }}</td>
              <td>{{$categoria->categoria }}</td>
              <td>{{ $categoria->descripcion }}</td>
              <td width="1rem" title="Editar: {{ $categoria->categoria }}">
                  @can('categoria.edit')
                    <a href="{{ route('categoria.edit', Crypt::encrypt($categoria->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
                  @endcan
              </td>
              <td width="1rem" title="Eliminar: {{ $categoria->categoria }}">
                  @can('categoria.destroy')
                    <form method="post" action="{{ route('categoria.destroy', Crypt::encrypt($categoria->id)) }}" id="categoriaDestroy{{ $categoria->id }}">
                      @method('DELETE')@csrf
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$categoria->id", 'onclick' => "return check('btnsub$categoria->id', 'categoriaDestroy$categoria->id', '¡Alerta!', 'Eliminarás este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $categoria->id ($categoria->categoria) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                    </form>
                  @endcan
              </td>
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
</div>
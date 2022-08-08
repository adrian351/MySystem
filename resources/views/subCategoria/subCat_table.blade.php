<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($subCategorias) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else
        <thead>
          <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('CATEGORIA') }}</th>
            <th>{{ __('SUBCATEGORIA') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th colspan="3">&nbsp</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($subCategorias as $subCategoria)
            <tr title={{ $subCategoria->id }}>
              <td>{{ $subCategoria->id }}</td>
                {{--  <td>{{ $subCategoria->categoria()->pluck('categoria')->first()}}</td>  --}}
                <td>
                    @foreach ($subCategoria->categoria as $cat)
                        {{ $cat->categoria }}
                    @endforeach
                </td>
                <td>{{$subCategoria->subcategoria }}</td>
                <td>{{ $subCategoria->descripcion }}</td>
                <td width="1rem" title="Editar: {{ $subCategoria->subcategoria }}">
                  @can('subCategoria.edit')
                    <a href="{{ route('subCategoria.edit', Crypt::encrypt($subCategoria->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
                  @endcan
                </td>
                <td width="1rem" title="Eliminar: {{ $subCategoria->subcategoria }}">
                  @can('subCategoria.destroy')
                    <form method="post" action="{{ route('subCategoria.destroy', Crypt::encrypt($subCategoria->id)) }}" id="subCategoriaDestroy{{ $subCategoria->id }}">
                      @method('DELETE')@csrf
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$subCategoria->id", 'onclick' => "return check('btnsub$subCategoria->id', 'subCategoriaDestroy$subCategoria->id', '¡Alerta!', 'Eliminarás este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $subCategoria->id ($subCategoria->subcategoria) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                    </form>
                  @endcan
              </td>
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
</div>
<table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
  @if(sizeof($precios) == 0)
    @include('layouts.private.busquedaSinResultados')
  @else 
    <thead>
      <tr> 
        <th>{{ __('AÑO') }}</th>
        <th>{{ __('PRECIO') }}</th>
        <th colspan="1">&nbsp</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($precios as $precio)
        <tr title="{{ $precio->year  }}">
          <td>{{ $precio->year }}</td>
          <td>{{ $precio->prec }}</td>
          @if(Request::route()->getName() == 'almacen.producto.edit')
            @include('almacen.producto.precios.pre_tableOpciones')
          @else
            <td></td>
          @endif
        </tr>
        @endforeach
    </tbody>
  @endif
</table>
<td>
  @can('almacen.producto.show')
    <a href="{{ route('almacen.producto.show', $id_producto) }}" target="{{ empty($target) ? __('') :  $target }}">{{ $producto->produc }}</a>
  @else
    {{ $producto->produc }}
  @endcan
</td>
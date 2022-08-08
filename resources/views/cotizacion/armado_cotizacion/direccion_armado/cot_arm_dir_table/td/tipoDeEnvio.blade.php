<td>
  @if($direccion->tip_env == config('opcionesSelect.select_tipo_de_envio.Express'))
    <span class="badge badge-info">{{ $direccion->tip_env }}</span>
  @else
    {{ $direccion->tip_env }}
  @endif
</td>
<td width="1rem" title="Editar: {{ $direccion->est }}">
  @if(Request::route()->getName()  == 'rolFerro.envioLocal.index')
    <a href="{{ route('rolFerro.envioLocal.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @else
    <a href="{{ route('rolFerro.envioForaneo.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endif
</td>
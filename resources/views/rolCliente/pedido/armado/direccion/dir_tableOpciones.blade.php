<td width="1rem" title="Editar: {{ $direccion->est }}">
  @if($direccion->nom_ref_uno == null)
    <a href="{{ route('rolCliente.pedido.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class='edit btn-info  btn-sm'><i class="fas fa-edit"></i></a>
  @endif
</td>


@section('css')
<style>
  .edit{
    text-align: center;
    color: black;
    background:rgb(255, 255, 255);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
  }
</style>
@endsection
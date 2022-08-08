{{--  comentada por marcar error  --}}
{{--  solo td  --}}
{{--  <td></td>   --}}
<td>
    {{ $direccion->comprobantes[0]->created_at }}

    {{--  para recorrer las direcciones  --}}
    {{--  @foreach ($direccion->comprobantes as $com)  --}}
        {{--  @if ($com->created_at == null)

            @else  --}}
            {{--  {{ $com->created_at }}  --}}
        {{--  @endif  --}}
        
    {{--  @endforeach  --}}
</td>
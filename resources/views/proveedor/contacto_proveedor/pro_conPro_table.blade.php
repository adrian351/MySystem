<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($contactos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE') }}</th>
          <th>{{ __('CARGO') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($contactos as $contacto)
          <tr title="{{ $contacto->nom  }}">
            <td width="1rem">{{ $contacto->id }}</td>
            <td>
              @canany(['proveedor.show', 'proveedor.contacto.show'])
                <a href="{{ route('proveedor.contacto.show', Crypt::encrypt($contacto->id)) }}" title="Detalles: {{ $contacto->nom  }}">{{ $contacto->nom }}</a>
              @else
                {{ $contacto->nom }}
              @endcanany
            </td>
            <td>{{ $contacto->carg }}</td>
            @if(Request::route()->getName() == 'proveedor.edit')
              @include('proveedor.contacto_proveedor.pro_conPro_tableOpciones')
            @else
            <td></td>
            <td></td>
            @endif
          </tr>
          @endforeach
      </tbody>
      @endif
  </table>
</div>
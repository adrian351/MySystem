<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($registros) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('MODULO') }}</th>
          <th>{{ __('REGISTRO') }}</th>
          <th>{{ __('FK') }}</th>
          <th>{{ __('USUARIO') }}</th>
          <th>{{ __('FECHA') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($registros as $registro)
          <tr title="{{ $registro->reg }}">
            <td width="1rem">{{ $registro->id }}</td>
            <td>{{ $registro->mod }}</td>
            <td>{{ $registro->id_reg }} ({{ $registro->reg }})</td>
            <td>{{ $registro->id_fk }}</td>
            <td>{{ $registro->deleted_at_reg }}</td>
            <td>{{ $registro->created_at }}</td>
            @include('papelera_de_reciclaje.pdr_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
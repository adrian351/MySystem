<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($marcas) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else
        <thead>
            <tr>
                <th>{{ __('Nombre') }}</th>
                <th>{{ __('Razón Social') }}</th>
                <th>{{ __('Comentarios') }}</th>
                <th>{{ __('Dominio') }}</th>
                <th>{{ __('Teléfono') }}</th>
                <th>{{ __('WhatsApp') }}</th>
                <th>{{ __('Email') }}</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody> 
            @foreach ($marcas as $marca)
            <tr>
                <td>{{$marca->marca}}</td>
                <td>{{$marca->razon_social}}</td>
                <td>{{ $marca->coment }}</td>
                <td>
                    @foreach ($marca->dominio as $dominio )
                    <span> {{$dominio->dominio}}</span>     
                    @endforeach
                </td>
                <td>
                    @foreach ($marca->telefono as $tel )     
                        @if ($tel->tipo=='local') 
                        {{-- obtener"tipo"denumeroporcoincidenciadetexto(tipo) --}}
                            <span> 
                                {{$tel->telefono}}
                                {{ $tel->tipo  }} 
                            </span> 
                            @else
                                <span> </span> 
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($marca->telefono as $tel )
                        @if ($tel->tipo=='whats_app') 
                            <span> 
                                {{$tel->telefono}}
                                {{ $tel->tipo  }}
                            </span>
                            @else
                                <span> </span>
                        @endif
                    @endforeach        
                </td>       
                <td>
                    @foreach ($marca->email as $email )
                        <span> {{$email->email}}</span>     
                    @endforeach
                </td>
                <td width="1rem" title="Editar: {{ $marca->marca }}">
                    @can('marca.edit')
                      <a href="{{ route('marca.edit', Crypt::encrypt($marca->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
                    @endcan
                </td>
                <td width="1rem" title="Eliminar: {{ $marca->marca }}">
                  @can('marca.destroy')
                    <form method="post" action="{{ route('marca.destroy', Crypt::encrypt($marca->id)) }}" id="marcaDestroy{{ $marca->id }}">
                      @method('DELETE')@csrf
                      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$marca->id", 'onclick' => "return check('btnsub$marca->id', 'marcaDestroy$marca->id', '¡Alerta!', 'Eliminarás este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $marca->id ($marca->marca) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                    </form>
                  @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
</div>
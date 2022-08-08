<div class="col-md">
    <div class="card card-outline">
        <div class="card-header p-1 border-bottom bg-dark">
            <h5 align="center">{{ __('Tarjetas de felicitación') }}</h5> 
        </div>
        <div class="card-body">    
            <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;">
                <table class="table table-head-fixed table-hover table-striped table-sm ">
                    <thead>
                    <tr>
                        <th scope="col">COD</th>
                        <th scope="col">CANT</th>
                        <th scope="col">{{ __('TIPO') }}</th>
                        <th scope="col">{{ __('MENSAJE') }}</th>
                        <th scope="col">{{ __('IMAGEN') }}</th>
                    </tr>
                    </thead>
                    <tbody> 
                        @foreach ($pedido->armados as $arm) 
                        @if (sizeof($arm->direcciones) == 0)
                            @include('layouts.private.busquedaSinResultados')
                            @else
                            @foreach ($arm->direcciones as $dir)
                                <tr>
                                <th scope="row">{{ $dir->cod }}</th>
                                <td>{{ $dir->cant }}</td>
                                <td>{{ $dir->tip_tarj_felic }}</td>
                                <td>{{ $dir->mens_dedic }}</td>
                                <td style="justify-content: center;">
                                    @if ($dir->tarj_dise_rut != null )
                                        <a href="{{$dir->tarj_dise_rut.$dir->tarj_dise_nom }}" class="imagen" title="Ver imagen">
                                            <i class="fas fa-image"></i>
                                        </a>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
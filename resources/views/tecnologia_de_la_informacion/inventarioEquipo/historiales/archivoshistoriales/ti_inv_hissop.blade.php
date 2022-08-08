<div class="card {{ config('app.color_card_secundario') }} card-outline">
    <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
        <h5>{{ __('Archivos') }}</h5> 
    </div>
    <div class="card-body">
        @if (sizeof($archivos) == 0)
                @include('layouts.private.busquedaSinResultados')       
            @else 
            <table class="table-sm">
              <tbody> 
                @foreach ($archivos as $archivo)
                  <tr title="{{ $archivo->id }}">
                    <td>
                      <a href="{{ $archivo->his_arch_rut.$archivo->his_arch }}" download title="Detalles: {{ $archivo->his_arch}}" >{{$archivo->his_arch}}</a>
                    </td>
                   </tr>
                @endforeach 
              </tbody>
            </table>
            <div class="pt-2">
                <div style="float: right;">
                  {!! $archivos->appends(Request::all())->links() !!}  
                </div>
                {{ __('Mostrando desde') . ' '. $archivos->firstItem() . ' ' . __('hasta') . ' '. $archivos->lastItem() . ' ' . __('de') . ' '. $archivos->total() . ' ' . __('registros') }}.
              </div>
        @endif    
    </div>
</div>
<div class="card {{ empty($armado->cant == $armado->cant_direc_carg) ? config('app.color_card_danger') : config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ empty($armado->cant == $armado->cant_direc_carg) ?  config('app.color_bg_danger') : config('app.color_bg_secundario') }}">
    @if(Request::route()->getName() == 'cotizacion.armado.edit')
      <div class="float-right">
        <a href="{{ route('cotizacion.armado.direccion.create', Crypt::encrypt($armado->id)) }}" class="btn btn-primary">
          <i class="fas fa-plus"></i> &nbsp;
          {{ __('Registrar dirección') }}
        </a>
      </div>
    @endif
    <h5>{{ __('Direcciones registradas') }} ({{ $armado->cant_direc_carg }} {{ __('de') }} {{ $armado->cant }})</h5>
  </div>
  <div class="card-body">
    @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones])
  </div>
</div>
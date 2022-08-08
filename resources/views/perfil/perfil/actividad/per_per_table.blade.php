<div class="border rounded p-1" id="div-tabla-scrollbar" style="height: 40em;">
  @if(sizeof($actividades) == 0)
    @include('layouts.private.busquedaSinResultados')
  @else 
    @foreach($actividades as $actividad)
      <div class="timeline timeline-inverse">
        <div class="time-label">
          <span class="bg-danger">
            {{ $actividad->created_at }}
          </span>
        </div>
        <div>
          <i class="fas fa-pen-nib bg-warning"></i>
          <div class="timeline-item">
            <span class="time"><i class="far fa-clock"></i> {{ $actividad->created_at->diffForHumans() }}</span>
            <h3 class="timeline-header">
              <strong>#</strong>{{ $actividad->id }}
              <strong>{{ __('Módulo') }}:</strong> {{ __($actividad->mod) }}
              <strong>{{ __('Registro') }}:</strong> <a href="{{ route($actividad->rut, $actividad->id_reg) }}" target="_blank">{{ $actividad->reg }}</a>
              <strong>Input:</strong> [{{ __($actividad->inpu) }}]
            </h3>
            <div class="timeline-body p-1">
              <div class="row">
                <div class="form-group col-sm"  style="border-right: 1px solid #dddd;border-bottom: 1px solid #dddd;">
                  {{ $actividad->ant }}
                </div>
                <div class="form-group col-sm">
                  {{ $actividad->nuev }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>
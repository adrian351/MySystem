<div class="modal fade" id="contacto" tabindex="-1" role="dialog" aria-labelledby="modalContacto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark p-1">
        <h5 class="modal-title" id="modalContacto">{{ __('Datos de contacto') }}</h5>
        <button type="button" class="close p-0 m-0 text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong><i class="fas fa-building"></i> {{ __('Empresa') }}</strong>
        <p class="text-muted">
          {{ Sistema::datos()->sistemaFindOrFail()->emp }}
        </p>
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> {{ __('Dirección') }}</strong>
        <p class="text-muted">
          {{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}<br>
          @if(Sistema::datos()->sistemaFindOrFail()->direc_dos != null){{ Sistema::datos()->sistemaFindOrFail()->direc_dos }}<br>@endif
          @if(Sistema::datos()->sistemaFindOrFail()->direc_tres != null){{ Sistema::datos()->sistemaFindOrFail()->direc_tres }}<br>@endif
        </p>
        <hr>
        <strong><i class="fas fa-envelope"></i> {{ __('Correos') }}</strong>
        <p class="text-muted">
          {{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}
          @if(Sistema::datos()->sistemaFindOrFail()->corr_opc_uno != null)<br>{{ Sistema::datos()->sistemaFindOrFail()->corr_opc_uno }}@endif
          @if(Sistema::datos()->sistemaFindOrFail()->corr_opc_dos != null)<br>{{ Sistema::datos()->sistemaFindOrFail()->corr_opc_dos }}@endif
          @if(Sistema::datos()->sistemaFindOrFail()->corr_opc_tres != null)<br>{{ Sistema::datos()->sistemaFindOrFail()->corr_opc_tres }}@endif
        </p>
        <hr>
        <strong><i class="fas fa-phone-square-alt"></i> {{ __('Teléfonos') }}</strong>
        <p class="text-muted">
          ({{ Sistema::datos()->sistemaFindOrFail()->lad_fij }}) {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} 
          @if(Sistema::datos()->sistemaFindOrFail()->ext != null){{ __('Extensión: ') . Sistema::datos()->sistemaFindOrFail()->ext }}@endif
          @if(Sistema::datos()->sistemaFindOrFail()->lad_mov != null)<br>({{ Sistema::datos()->sistemaFindOrFail()->lad_mov }}) {{ Sistema::datos()->sistemaFindOrFail()->tel_mov  }}@endif
        </p>
        <hr>
        <strong><i class="fas fa-globe"></i> {{ __('Página web') }}</strong>
        <p class="text-muted"><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->pag }}">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></p>
        <hr>
        @include('layouts.redesSociales')
        <p class="text-muted p-0 m-0 float-right"><strong> {{ __('Versión') }}</strong> {{ config('app.version_del_sistema') }}</p>
      </div>
      <div class="row p-0">
        <div class="form-group col-sm btn-sm">
          <center><button type="button" class="btn btn-default w-75 p-2 border" data-dismiss="modal"><i class="far fa-times-circle"></i> {{ __('Cerrar') }}</button></center>
        </div>
      </div>
    </div>
  </div>
</div>
  <div id="infoExtra"> 
    <div class="card">
      <div class="card-header p-2" id="headingInfo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#collapseInfo" aria-expanded="false" aria-controls="collapseInfo">
            <i class="fas fa-id-card"></i>&nbsp;
            <b>{{ __('TARJETA DE DEDICATORIA') }}</b>
          </button>
        </h5>
      </div>
      <div id="collapseInfo" class="collapse" aria-labelledby="headingInfo" data-parent="#infoExtra">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="pad">
                <div class="row">
                  <div class="form-group col-sm btn-sm">
                    <label for="tipo_de_tarjeta_de_felicitacion">{{ __('Tipo de tarjeta de felicitación') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                      </div>
                      {!! Form::select('tipo_de_tarjeta_de_felicitacion', config('opcionesSelect.select_tarjeta_de_felicitacion'), $direccion->tip_tarj_felic, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
                    </div>
                  </div>
                </div>
                <div class="row" id="mensaje_de_dedicatoria">
                  <div class="form-group col-sm btn-sm">
                    <label for="mensaje_de_dedicatoria">{{ __('Mensaje de dedicatoria') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                      </div>
                      {!! Form::textarea('mensaje_de_dedicatoria',  $direccion->mens_dedic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Mensaje de dedicatoria'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              @if($direccion->tarj_dise_nom != null)
                <div class="form-group col-sm btn-sm">
                  <a href="{{ $direccion->tarj_dise_rut.$direccion->tarj_dise_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
                  <label for="comentarios">{{ __('Tarjeta diseñada por el cliente') }}</label>
                  <div class="pad box-pane-right no-padding" style="min-height: 240px">
                    <iframe src="{{ $direccion->tarj_dise_rut.$direccion->tarj_dise_nom }}" style="width:100%;border:none;height:20rem;"></iframe>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
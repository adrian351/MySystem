<label for="envio_al_que_se_cotizo">{{ __('ENVÍO AL QUE SE COTIZO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="col-md">
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::text('metodo_de_entrega', $direccion->met_de_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="estado">{{ __('Estado') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::text('estado', $direccion->est, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Estado'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
        <div class="form-group col-sm-4 btn-sm">
          <label for="foraneo_o_local">{{ __('Foráneo o local') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::text('foraneo_o_local', $direccion->for_loc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Foráneo o local'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="tipo_de_envio">{{ __('Tipo de envío') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::text('tipo_de_envio', $direccion->tip_env, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="costo_por_envio">{{ __('Costo de envío') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::text('costo_por_envio', Sistema::dosDecimales($direccion->cost_por_env), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="form-group col-sm btn-sm">
        <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
          {!! Form::textarea('detalles_de_la_ubicacion', $direccion->detalles_de_la_ubicacion, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Detalles de la ubicación'), 'readonly' => 'readonly']) !!}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="border border-primary rounded p-2" :class="{ 'border-danger': hasError }">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="tipo_de_empaque">{{ __('Tipo de empaque') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('tipo_de_empaque', null, ['v-model' => 'tipo_de_empaque', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de empaque'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="cuenta_con_seguro">{{ __('Cuenta con seguro') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('cuenta_con_seguro', null, ['v-model' => 'cuenta_con_seguro', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Cuenta con seguro'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="tiempo_de_entrega">{{ __('Tiempo de entrega') }} {{ __('(Dias)') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
        </div>
        {!! Form::text('tiempo_de_entrega', null, ['v-model' => 'tiempo_de_entrega', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Tiempo de entrega'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega', $direccion->met_de_entreg, ['v-model' => 'metodo_de_entrega', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="estado_al_que_se_cotizo">{{ __('Estado al que se cotizó') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('estado_al_que_se_cotizo', $direccion->est, ['v-model' => 'estado_al_que_se_cotizo', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Estado al que se cotizó'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="foraneo_o_local">{{ __('Foráneo o local') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('foraneo_o_local', null, ['v-model' => 'foraneo_o_local', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Foráneo o local'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('tipo_de_envio', null, ['v-model' => 'tipo_de_envio', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}    
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="costo_de_envio">{{ __('Costo de envío') }} *</label> <span v-if="errors.costo_seleccionado" class="text-danger" v-text="errors.costo_seleccionado[0]"></span>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('costo_de_envio', null, ['v-model' => 'costo_de_envio', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('cantidad', null, ['v-on:change' => 'getCostoDeEnvio', 'v-model' => 'cantidad', 'class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad'), 'required']) !!}
    </div>
    <span v-if="errors.cantidad" class="text-danger" v-text="errors.cantidad[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('detalles_de_la_ubicacion', null, ['v-model' => 'detalles_de_la_ubicacion', 'class' => 'form-control', 'maxlength' => 150, 'placeholder' => __('Detalles de la ubicación'), 'rows' => 4, 'cols' => 4, 'required']) !!}
    </div>
    <span v-if="errors.detalles_de_la_ubicacion" class="text-danger" v-text="errors.detalles_de_la_ubicacion[0]"></span>
  </div>
</div>
<label for="costo_de_envio_seleccionado">{{ __('COSTO DE ENVÍO SELECCIONADO') }}</label>  <span v-if="errors.costo_seleccionado" class="text-danger" v-text="errors.costo_seleccionado[0]"></span>
<div class="border border-primary rounded p-2" :class="{ 'border-danger': hasError }">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="foraneo_o_local">{{ __('Foráneo o local') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('foraneo_o_local', null, ['v-model' => 'foraneo_o_local', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Foráneo o local'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega', null, ['v-model' => 'metodo_de_entrega', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
     <label for="metodo_de_entrega_especifico">{{ __('Método de entrega especifico') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('metodo_de_entrega_especifico', null, ['v-model' => 'metodo_de_entrega_especifico', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega especifico'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>  
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="cantid">{{ __('Cantidad') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('cantid', null, ['v-model' => 'cantid', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="transporte">{{ __('Transporte') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('transporte', null, ['v-model' => 'transporte', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Transporte'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="estado_al_que_se_cotizo">{{ __('Estado al que se cotizó') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('estado_al_que_se_cotizo', null, ['v-model' => 'estado_al_que_se_cotizo', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Estado al que se cotizó'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="municipio">{{ __('Municipio') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('municipio', null, ['v-model' => 'municipio', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Municipio'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="total_o_unitario">{{ __('Total o unitario') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('total_o_unitario', null, ['v-model' => 'total_o_unitario', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Total o unitario'), 'readonly' => 'readonly']) !!}  
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
        {!! Form::text('tipo_de_envio', null, ['v-model' => 'tipo_de_envio', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}    
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="taman">{{ __('Tamaño') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('taman', null, ['v-model' => 'taman', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Tamaño'), 'readonly' => 'readonly']) !!}    
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="costo_de_caja">{{ __('Costo de caja') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('costo_de_caja', null, ['v-model' => 'costo_de_caja', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Costo de caja'), 'readonly' => 'readonly']) !!}    
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="cuenta_con_seguro">{{ __('Cuenta con seguro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('cuenta_con_seguro', null, ['v-model' => 'cuenta_con_seguro', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Cuenta con seguro'), 'readonly' => 'readonly']) !!}  
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="tiempo_de_entrega">{{ __('Tiempo de entrega') }} {{ __('(Dias)') }}</label>
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
      <label for="costo_de_envio_individual">{{ __('Costo de envío individual') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('costo_de_envio_individual', null, ['v-model' => 'costo_de_envio_individual', 'class' => 'form-control form-control-sm disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío individual'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="costo_de_envio">{{ __('Costo de envío') }}</label>
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
    <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('detalles_de_la_ubicacion', null, ['v-model' => 'detalles_de_la_ubicacion', 'class' => 'form-control', 'maxlength' => 150, 'placeholder' => __('Detalles de la ubicación'), 'rows' => 2, 'cols' => 4]) !!}
    </div>
    <span v-if="errors.detalles_de_la_ubicacion" class="text-danger" v-text="errors.detalles_de_la_ubicacion[0]"></span>
  </div>
</div>
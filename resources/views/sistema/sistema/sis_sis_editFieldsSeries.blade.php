<label for="redes_sociales">{{ __('SERIES') }}</label>
  <div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="serie_por_default_cotizaciones">{{ __('Serie por default "Cotizaciones"') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::select('serie_por_default_cotizaciones', $ser_cotizaciones, Sistema::datos()->sistemaFindOrFail()->ser_cotizaciones, ['class' => 'form-control select2' . ($errors->has('serie_por_default_cotizaciones') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}  
      </div>
      <span class="text-danger">{{ $errors->first('serie_por_default_cotizaciones') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="serie_por_default_pedidos">{{ __('Serie por default "Pedidos"') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::select('serie_por_default_pedidos', $ser_pedidos, Sistema::datos()->sistemaFindOrFail()->ser_pedidos, ['class' => 'form-control select2' . ($errors->has('serie_por_default_pedidos') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}  
      </div>
      <span class="text-danger">{{ $errors->first('serie_por_default_pedidos') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_pago">{{ __('Comprobante de pago') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('comprobante_de_pago', ['class' => 'custom-file-input' . ($errors->has('comprobante_de_pago') ? ' is-invalid' : ''), 'accept' => 'image/jpeg,image/png,image/jpg,application/pdf', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://www.ilovepdf.com/es/comprimir_pdf/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('comprobante_de_pago:') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="div_ultimos_8_digitos_del_folio_de_pago">
    <label for="ultimos_8_digitos_del_folio_de_pago">{{ __('Últimos 8 dígitos del folio de pago') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('ultimos_8_digitos_del_folio_de_pago', null, ['id' => 'ultimos_8_digitos_del_folio_de_pago', 'class' => 'form-control' . ($errors->has('ultimos_8_digitos_del_folio_de_pago') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('Últimos 8 dígitos del folio de pago')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ultimos_8_digitos_del_folio_de_pago') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="forma_de_pago">{{ __('Forma de pago') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('forma_de_pago', config('opcionesSelect.select_forma_de_pago'), null, ['id' => 'forma_de_pago', 'class' => 'form-control select2' . ($errors->has('forma_de_pago') ? ' is-invalid' : ''), 'placeholder' => __('') , 'onChange' => 'getFormaDePago();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('forma_de_pago') }}</span>
  </div>
  <div class="form-group col-sm btn-sm" id="div_copia_de_identificacion">
    <label for="copia_de_identificacion">{{ __('Copia de identificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('copia_de_identificacion', ['class' => 'custom-file-input' . ($errors->has('copia_de_identificacion') ? ' is-invalid' : ''), 'accept' => 'image/jpeg,image/png,image/jpg,application/pdf', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://www.ilovepdf.com/es/comprimir_pdf/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('copia_de_identificacion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="monto_del_pago">{{ __('Monto del pago') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('monto_del_pago', null, ['id' => 'monto_del_pago', 'class' => 'form-control' . ($errors->has('monto_del_pago') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Monto del pago'), 'onChange' => 'getMontoDelPago();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('monto_del_pago') }}</span>
  </div>
</div>
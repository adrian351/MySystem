<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="factura_pdf">{{ __('Factura PDF') }}</label>
    <div class="input-group">
      @if($factura->fact_pdf_nom != null)
        <a href="{{ $factura->fact_pdf_rut.$factura->fact_pdf_nom }}" class="btn btn-light border mr-2" title="{{ __('Descargar factura PDF') }}"><i class="fas fa-download"></i></a>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('factura_pdf', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('factura_pdf') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="factura_xlm">{{ __('Factura XLM') }}</label>
    <div class="input-group">
      @if($factura->fact_xlm_nom != null)
        <a href="{{ $factura->fact_xlm_rut.$factura->fact_xlm_nom }}" class="btn btn-light border mr-2" title="{{ __('Descargar factura XLM') }}"><i class="fas fa-download"></i></a>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('factura_xlm', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('factura_xlm') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="ppd_pdf">{{ __('PPD PDF') }}</label>
    <div class="input-group">
      @if($factura->ppd_pdf_nom != null)
        <a href="{{ $factura->ppd_pdf_rut.$factura->ppd_pdf_nom }}" class="btn btn-light border mr-2" title="{{ __('Descargar PPD PDF') }}"><i class="fas fa-download"></i></a>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('ppd_pdf', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('ppd_pdf') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ppd_xlm">{{ __('PPD XLM') }}</label>
    <div class="input-group">
      @if($factura->ppd_xlm_nom != null)
        <a href="{{ $factura->ppd_xlm_rut.$factura->ppd_xlm_nom }}" class="btn btn-light border mr-2" title="{{ __('Descargar PPD XLM') }}"><i class="fas fa-download"></i></a>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('ppd_xlm', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('ppd_xlm') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('factura.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'facturaUpdateSubirArchivos', '¡Alerta!', '¿Estás seguro quieres subir estos archivos?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Subir archivos') }}</button>
  </div>
</div>
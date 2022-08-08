@if($factura->fact_pdf_nom != null OR $factura->fact_xlm_nom != null OR $factura->ppd_pdf_nom != null OR $factura->ppd_xlm_nom != null)
  <label for="redes_sociales">{{ __('DOCUMENTOS FACTURA') }}</label>
  <div class="border border-primary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        @if($factura->fact_pdf_nom != null)
          <a href="{{ $factura->fact_pdf_rut.$factura->fact_pdf_nom }}" class="btn btn-primary" download>{{ __('Factura (PDF)') }}</a>
        @endif

        @if($factura->fact_xlm_nom != null)
          <a href="{{ $factura->fact_xlm_rut.$factura->fact_xlm_nom }}" class="btn btn-primary" download>{{ __('Factura (XLM)') }}</a>
        @endif

        @if($factura->ppd_pdf_nom != null)
          <a href="{{ $factura->ppd_pdf_rut.$factura->ppd_pdf_nom }}" class="btn btn-primary" download>{{ __('PPD (PDF)') }}</a>
        @endif

        @if($factura->ppd_xlm_nom != null)
          <a href="{{ $factura->ppd_xlm_rut.$factura->ppd_xlm_nom }}" class="btn btn-primary" download>{{ __('PPD (XLM)') }}</a>
        @endif
      </div>
    </div>
  </div>
@endif
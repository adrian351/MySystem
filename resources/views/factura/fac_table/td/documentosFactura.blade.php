<th width="1rem">
  @if($factura->fact_pdf_nom != null)
    <a href="{{ $factura->fact_pdf_rut.$factura->fact_pdf_nom }}" class='btn btn-light btn-sm' download><i class="fas fa-file-pdf"></i></a>
  @endif
</th>

<th width="1rem">
  @if($factura->fact_xlm_nom != null)
    <a href="{{ $factura->fact_xlm_rut.$factura->fact_xlm_nom }}" class='btn btn-light btn-sm' download><i class="fas fa-file-alt"></i></a>
  @endif
</th>

<th width="1rem">
  @if($factura->ppd_pdf_nom != null)
  <a href="{{ $factura->ppd_pdf_rut.$factura->ppd_pdf_nom }}" class='btn btn-light btn-sm' download><i class="fas fa-file-pdf"></i></a>
  @endif
</th>

<th width="1rem">
  @if($factura->ppd_xlm_nom != null)
  <a href="{{ $factura->ppd_xlm_rut.$factura->ppd_xlm_nom }}" class='btn btn-light btn-sm' download><i class="fas fa-file-alt"></i></a>
  @endif
</th>
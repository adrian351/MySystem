@if($armado->comp_de_sali_nom != null)
  <div class="col-md-5">
    <div class="pad box-pane-right no-padding" style="min-height: 280px">
      <iframe src="{{ $armado->comp_de_sali_rut.$armado->comp_de_sali_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
    </div>
  </div>
@endif
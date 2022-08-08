<div class="pt-2">
  <div style="float: right;">
    {!! $paginar->appends(Request::all())->links() !!}  
  </div>
  {{ __('Mostrando desde') . ' '. $paginar->firstItem() . ' ' . __('hasta') . ' '. $paginar->lastItem() . ' ' . __('de') . ' '. $paginar->total() . ' ' . __('registros') }}.
</div>
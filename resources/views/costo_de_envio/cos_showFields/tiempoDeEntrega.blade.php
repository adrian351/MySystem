<div class="form-group col-sm btn-sm">
  <label for="tiempo_de_entrega">{{ __('Tiempo de entrega') }} ({{ __('Dias') }})</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
    </div>
    {!! Form::text('tiempo_de_entrega', $costo_de_envio->tiemp_ent, ['class' => 'form-control', 'placeholder' => __('Tiempo de entrega'), 'readonly' => 'readonly']) !!}
  </div>
</div>
<div class="form-group col-sm btn-sm">
  <label for="sku">{{ __('SKU') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('sku', $armado->sku, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('SKU'), 'readonly' => 'readonly']) !!}
  </div>
</div>
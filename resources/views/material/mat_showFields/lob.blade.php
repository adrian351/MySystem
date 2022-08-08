<div class="form-group col-sm btn-sm">
  <label for="lob">{{ __('Lob') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('lob', $material->lob, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Lob'), 'readonly' => 'readonly']) !!}
  </div>
</div>
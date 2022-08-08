@if ($armado->regalo != null)
<div class="form-group col-sm btn-sm">
  <label for="regalo">{{ __('Regalo') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('regalo', $armado->regalo, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Regalo'), 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif

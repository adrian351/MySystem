@if ($armado->autorizado != null)
<div class="form-group col-sm btn-sm">
  <label for="autorizado">{{ __('Autorizado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('autorizado', $armado->autorizado, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Autorizado'), 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif
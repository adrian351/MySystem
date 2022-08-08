<div class="form-group col-sm btn-sm">
  <label for="gama">{{ __('Gama') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
    </div>
    {!! Form::text('gama', $armado->gama, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Gama'), 'readonly' => 'readonly']) !!}
  </div>
</div>
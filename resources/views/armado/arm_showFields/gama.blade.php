<div class="form-group col-sm btn-sm">
  <label for="gama">{{ __('Gama') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
    </div>
    {!! Form::select('gama', [$armado->gama => $armado->gama], $armado->gama, ['class' => 'form-control disabled select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
  </div>
</div>
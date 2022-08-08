@if ($armado->obs != null)
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="observaciones">{{ __('Observaciones') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('observaciones', $armado->obs, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Observaciones'),'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
@endif

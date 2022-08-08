@if ($armado->url_pagina != null)
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL página') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', $armado->url_pagina, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('URL página'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
@endif
<label for="redes_sociales">{{ __('REDES SOCIALES') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="pagina_web">{{ __('Página web') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-globe"></i></span>
        </div>
        {!! Form::text('pagina_web', Sistema::datos()->sistemaFindOrFail()->pag, ['class' => 'form-control' . ($errors->has('pagina_web') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Página web')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('pagina_web') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="facebook">{{ __('Facebook') }} </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fab fa-facebook"></i></span>
        </div>
        {!! Form::text('facebook', Sistema::datos()->sistemaFindOrFail()->red_fbk, ['class' => 'form-control' . ($errors->has('facebook') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Facebook')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('facebook') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="twitter">{{ __('Twitter') }} </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fab fa-twitter-square"></i></span>
        </div>
        {!! Form::text('twitter', Sistema::datos()->sistemaFindOrFail()->red_tw, ['class' => 'form-control' . ($errors->has('twitter') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Twitter')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('twitter') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="instagram">{{ __('Instagram') }} </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fab fa-instagram"></i></span>
        </div>
        {!! Form::text('instagram', Sistema::datos()->sistemaFindOrFail()->red_ins, ['class' => 'form-control' . ($errors->has('instagram') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Instagram')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('instagram') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="linkedin">{{ __('Linkedin') }} </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
        </div>
        {!! Form::text('linkedin', Sistema::datos()->sistemaFindOrFail()->red_link, ['class' => 'form-control' . ($errors->has('linkedin') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Linkedin')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('linkedin') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="youtube">{{ __('Youtube') }} </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fab fa-youtube"></i></span>
        </div>
        {!! Form::text('youtube', Sistema::datos()->sistemaFindOrFail()->red_youtube, ['class' => 'form-control' . ($errors->has('youtube') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Youtube')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('youtube') }}</span>
    </div>
  </div>
</div>
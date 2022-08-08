<label for="redes_sociales">{{ __('IMAGENES') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="logo_color_negr">{{ __('Logo color negro') }} (583 x 239px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('logo_color_negro', ['id' => 'logo_color_negro', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("logo_color_negro", "visualizar-logo-color-negro")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('logo_color_negro') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->log_blan_rut . Sistema::datos()->sistemaFindOrFail()->log_blan }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="logo_color_blanc">{{ __('Logo color blanco') }} (583 x 239px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('logo_color_blanco', ['id' => 'logo_color_blanco', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("logo_color_blanco", "visualizar-logo-color-blanco")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('logo_color_blanco') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-logo-color-negro"></div>
      </figure></center>
    </div>
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-logo-color-blanco"></div>
      </figure></center>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->carrus_login_rut . Sistema::datos()->sistemaFindOrFail()->carrus_login }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_logi">{{ __('Imagen login') }} (1200 x 800px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_login', ['id' => 'imagen_login', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_login", "visualizar-imagen-login")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_login') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->carrus_reque_rut . Sistema::datos()->sistemaFindOrFail()->carrus_reque }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_restablecer_la_contraseñ">{{ __('Imagen restablecer la contraseña') }} (1200 x 800px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_restablecer_la_contraseña', ['id' => 'imagen_restablecer_la_contraseña', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_restablecer_la_contraseña", "visualizar-imagen-restablecer-la-contraseña")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_restablecer_la_contraseña') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-login"></div>
      </figure></center>
    </div>
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-restablecer-la-contraseña"></div>
      </figure></center>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->carrus_rese_rut . Sistema::datos()->sistemaFindOrFail()->carrus_rese }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_nueva_contraseñ">{{ __('Imagen nueva contraseña') }} (1200 x 800px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_nueva_contraseña', ['id' => 'imagen_nueva_contraseña', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_nueva_contraseña", "visualizar-imagen-nueva-contraseña")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_nueva_contraseña') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_predeterminada_del_perfi">{{ __('Imagen predeterminada del perfil') }} (300 x 300px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_predeterminada_del_perfil', ['id' => 'imagen_predeterminada_del_perfil', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_predeterminada_del_perfil", "visualizar-imagen-predeterminada-del-perfil")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_predeterminada_del_perfil') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-nueva-contraseña"></div>
      </figure></center>
    </div>
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-predeterminada-del-perfil"></div>
      </figure></center>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->img_construc_rut . Sistema::datos()->sistemaFindOrFail()->img_construc }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_modulo_en_desarroll">{{ __('Imagen módulo en desarrollo') }} (860 x 563px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_modulo_en_desarrollo', ['id' => 'imagen_modulo_en_desarrollo', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_modulo_en_desarrollo", "visualizar-imagen-modulo-en-desarrollo")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_modulo_en_desarrollo') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <a href="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}" class="alert-link" title="{{ __('Descargar') }}" download><label for="imagen_erro">{{ __('Imagen error') }} (960 x 752px)</label></a>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
        </div>
        <div class="custom-file"> 
          {!! Form::file('imagen_error', ['id' => 'imagen_error', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_error", "visualizar-imagen-error")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
          <label class="custom-file-label" for="archivo">Max. 1MB</label>
        </div>
        <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
      </div>
      <span class="text-danger">{{ $errors->first('imagen_error') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-modulo-en-desarrollo"></div>
      </figure></center>
    </div>
    <div class="form-group col-sm btn-sm">
      <center><figure>
        <div id="visualizar-imagen-error"></div>
      </figure></center>
    </div>
  </div>
</div>
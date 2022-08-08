<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_o_razon_social">{{ __('Nombre o razón social') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('nombre_o_razon_social', $dato_fiscal->nom_o_raz_soc, ['id' => 'nombre_o_razon_social', 'class' => 'form-control' . ($errors->has('nombre_o_razon_social') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Nombre o razón social')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_o_razon_social') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="rfc">{{ __('RFC') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('rfc', $dato_fiscal->rfc, ['id' => 'rfc', 'class' => 'form-control' . ($errors->has('rfc') ? ' is-invalid' : ''), 'maxlength' => 20, 'placeholder' => __('RFC')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('rfc') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', $dato_fiscal->lad_fij, ['id' => 'lada_telefono_fijo', 'class' => 'form-control' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono fijo')]) !!}
      {!! Form::text('telefono_fijo', $dato_fiscal->tel_fij, ['id' => 'telefono_fijo', 'class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_fijo') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
       {!! Form::text('extension', $dato_fiscal->ext, ['id' => 'extension', 'class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
       {!! Form::number('lada_telefono_movil', $dato_fiscal->lad_mov, ['id' => 'lada_telefono_movil', 'class' => 'form-control' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono móvil')]) !!}
       {!! Form::text('telefono_movil', $dato_fiscal->tel_mov, ['id' => 'telefono_movil', 'class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="calle">{{ __('Calle') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-road"></i></span>
      </div>
        {!! Form::text('calle', $dato_fiscal->calle, ['id' => 'calle', 'class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'maxlength' => 45, 'placeholder' => __('Calle')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('calle') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_exterior">{{ __('No. Exterior') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_exterior', $dato_fiscal->no_ext, ['id' => 'no_exterior', 'class' => 'form-control' . ($errors->has('no_exterior') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('No. Exterior')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('no_exterior') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_interior">{{ __('No. Interior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_interior', $dato_fiscal->no_int, ['id' => 'no_interior', 'class' => 'form-control' . ($errors->has('no_interior') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('No. Interior')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('no_interior') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="pais">{{ __('País') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('pais', $dato_fiscal->pais, ['id' => 'pais', 'class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('País')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('pais') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ciudad">{{ __('Ciudad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
      </div>
      {!! Form::text('ciudad', $dato_fiscal->ciudad, ['id' => 'ciudad', 'class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ciudad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ciudad') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="colonia">{{ __('Colonia') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('colonia', $dato_fiscal->col, ['id' => 'colonia', 'class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Colonia')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('colonia') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-city"></i></span>
      </div>
      {!! Form::text('delegacion_o_municipio', $dato_fiscal->del_o_munic, ['id' => 'delegacion_o_municipio', 'class' => 'form-control' . ($errors->has('delegacion_o_municipio') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Delegación o municipio')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('delegacion_o_municipio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_postal">{{ __('Código postal') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
      </div>
        {!! Form::text('codigo_postal', $dato_fiscal->cod_post, ['id' => 'codigo_postal', 'class' => 'form-control' . ($errors->has('codigo_postal') ? ' is-invalid' : ''), 'maxlength' => 6, 'placeholder' => __('Código postal')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_postal') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="correo">{{ __('Correo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
        {!! Form::text('correo', $dato_fiscal->corr, ['id' => 'correo', 'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('correo') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
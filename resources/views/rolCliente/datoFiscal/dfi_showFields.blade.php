<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_o_razon_social">{{ __('Nombre o razón social') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('nombre_o_razon_social', $dato_fiscal->nom_o_raz_soc, ['class' => 'form-control disabled', 'maxlength' => 00, 'placeholder' => __('Nombre o razón social'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="rfc">{{ __('RFC') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('rfc', $dato_fiscal->rfc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('RFC'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', $dato_fiscal->lad_fij, ['class' => 'form-control disabled', 'min' => 1, 'max' => 0, 'placeholder' => __('Lada teléfono fijo'), 'readonly' => 'readonly']) !!}
      {!! Form::text('telefono_fijo', $dato_fiscal->tel_fij, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono fijo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
        {!! Form::text('extension', $dato_fiscal->ext, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Extensión'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        {!! Form::number('lada_telefono_movil', $dato_fiscal->lad_mov, ['class' => 'form-control disabled', 'min' => 1, 'max' => 0, 'placeholder' => __('Lada teléfono móvil'), 'readonly' => 'readonly']) !!}
        {!! Form::text('telefono_movil', $dato_fiscal->tel_mov, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono móvil'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="calle">{{ __('Calle') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-road"></i></span>
      </div>
        {!! Form::text('calle', $dato_fiscal->calle, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Calle'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_exterior">{{ __('No. Exterior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_exterior', $dato_fiscal->no_ext, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Exterior'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_interior">{{ __('No. Interior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_interior', $dato_fiscal->no_int, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Interior'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="pais">{{ __('País') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('pais', $dato_fiscal->pais, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('País'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ciudad">{{ __('Ciudad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
      </div>
      {!! Form::text('ciudad', $dato_fiscal->ciudad, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ciudad'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="colonia">{{ __('Colonia') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('colonia', $dato_fiscal->col, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Colonia'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-city"></i></span>
      </div>
      {!! Form::text('delegacion_o_municipio',  $dato_fiscal->del_o_munic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Delegación o municipio'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_postal">{{ __('Código postal') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
      </div>
        {!! Form::text('codigo_postal',  $dato_fiscal->cod_post, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código postal'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="correo">{{ __('Correo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
        {!! Form::text('correo', $dato_fiscal->corr, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Correo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
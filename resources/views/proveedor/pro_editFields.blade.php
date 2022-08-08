<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="razon_social">{{ __('Razón social') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('razon_social', $proveedor->raz_soc, ['class' => 'form-control' . ($errors->has('razon_social') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Razón social')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('razon_social') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_comercial">{{ __('Nombre comercial') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_comercial', $proveedor->nom_comerc , ['class' => 'form-control' . ($errors->has('nombre_comercial') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Nombre comercial')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_comercial') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="fabricante_distribuidor">{{ __('Fabricante / Distribuidor') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('fabricante_distribuidor', config('opcionesSelect.select_fabricante_distribuidor_index'), $proveedor->fab_distri, ['class' => 'form-control select2' . ($errors->has('fabricante_distribuidor') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('fabricante_distribuidor') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="rfc">{{ __('RFC') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('rfc', $proveedor->rfc, ['class' => 'form-control' . ($errors->has('rfc') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('RFC')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('rfc') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_representante_legal">{{ __('Nombre del representante legal') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_del_representante_legal', $proveedor->nom_rep_legal, ['class' => 'form-control' . ($errors->has('nombre_del_representante_legal') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Nombre del representante legal')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_representante_legal') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="pagina_web">{{ __('Página web') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe"></i></span>
      </div>
      {!! Form::text('pagina_web', $proveedor->pag_web, ['class' => 'form-control disabled' . ($errors->has('pagina_web') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Página web')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('pagina_web') }}</span>
  </div>
</div>
{{-- telefono de contacto --}}
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      <div>
        {!! Form::number('lada_telefono_fijo', $proveedor->lad_fij, ['class' => 'form-control disabled' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada '),  'readonly' => 'readonly']) !!}
      </div>
      {!! Form::text('telefono_fijo', $proveedor->tel_fij, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo'), ]) !!}
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
        {!! Form::text('extension', $proveedor->ext, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        <div>
          {!! Form::number('lada_telefono_movil', $proveedor->lad_mov, ['class' => 'form-control disabled' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada '),  'readonly' => 'readonly']) !!}
        </div>
        {!! Form::text('telefono_movil', $proveedor->tel_mov, ['class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_o_monto_minimo_de_compra">{{ __('Cantidad o monto mínimo de compra') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('opcion', config('opcionesSelect.select_opcion_prov'), $proveedor->ops, ['class' => 'form-control' . ($errors->has('opcion') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
      {!! Form::text('cantidad_o_monto_minimo_de_compra', $proveedor->cant_min_comp, ['class' => 'form-control' . ($errors->has('cantidad_o_monto_minimo_de_compra') ? ' is-invalid' : ''), 'maxlength' => 25, 'placeholder' => __('Cantidad o monto mínimo de compra')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('opcion') }}</span>
    <span class="text-danger">{{ $errors->first('cantidad_o_monto_minimo_de_compra') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $proveedor->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="archivo">{{ __('Archivo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivo', ['id' => 'archivo', 'class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivo') }}</span>
  </div>
</div>
<label for="redes_sociales">{{ __('DIRECCIÓN') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="calle">{{ __('Calle') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-road"></i></span>
        </div>
        {!! Form::text('calle', $proveedor->call, ['class' => 'form-control' . ($errors->has('calle') ? ' is-invalid' : ''), 'maxlength' => 45, 'placeholder' => __('Calle')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('calle') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="no_ext">{{ __('No. Ext.') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('no_ext', $proveedor->no_ext, ['class' => 'form-control' . ($errors->has('no_ext') ? ' is-invalid' : ''), 'maxlength' => 8, 'placeholder' => __('No. Ext.')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('no_ext') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="no_int">{{ __('No. Int.') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('no_int', $proveedor->no_int, ['class' => 'form-control' . ($errors->has('no_int') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('No. Int.')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('no_int') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="pais">{{ __('País') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('pais', $proveedor->pais, ['class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('País')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('pais') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="ciudad">{{ __('Ciudad') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
        </div>
        {!! Form::text('ciudad', $proveedor->ciudad, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ciudad')]) !!}
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
        {!! Form::text('colonia', $proveedor->col, ['class' => 'form-control' . ($errors->has('colonia') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Colonia')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('colonia') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-city"></i></span>
        </div>
        {!! Form::text('delegacion_o_municipio', $proveedor->del_o_munic, ['class' => 'form-control' . ($errors->has('delegacion_o_municipio') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Delegación o municipio')]) !!}
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
        {!! Form::text('codigo_postal', $proveedor->cod_post, ['class' => 'form-control' . ($errors->has('codigo_postal') ? ' is-invalid' : ''), 'maxlength' => 6, 'placeholder' => __('Código postal')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('codigo_postal') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="referencias">{{ __('Referencias') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('referencias', $proveedor->ref, ['class' => 'form-control' . ($errors->has('referencias') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Referencias'), 'rows' => 4, 'cols' => 4]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('referencias') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('proveedor.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'proveedorUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
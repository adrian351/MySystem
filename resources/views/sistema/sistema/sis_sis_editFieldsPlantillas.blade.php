<label for="redes_sociales">{{ __('PLANTILLAS') }}</label>
<div class="border border-primary rounded p-2">
  <label for="redes_sociales">{{ __('MÓDULO USUARIOS') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_bienvenida_usuarios">{{ __('Plantilla por default "Bienvenida"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_bienvenida_usuarios', $plantillas_usu_bien, Sistema::datos()->sistemaFindOrFail()->plant_usu_bien, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_bienvenida_usuarios') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_bienvenida_usuarios') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO CLIENTES') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_bienvenida_clientes">{{ __('Plantilla por default "Bienvenida"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_bienvenida_clientes', $plantillas_cli_bien, Sistema::datos()->sistemaFindOrFail()->plant_cli_bien, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_bienvenida_clientes') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_bienvenida_clientes') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO PERFIL') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_cambio_de_password">{{ __('Plantilla por default "Cambio de contraseña"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_cambio_de_password', $plantillas_per_camb_pass, Sistema::datos()->sistemaFindOrFail()->plant_per_camb_pass, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_cambio_de_password') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_cambio_de_password') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO SISTEMA') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_restablecimiento_de_password">{{ __('Plantilla por default "Restablecimiento de contraseña"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_restablecimiento_de_password', $plantillas_sis_rest_pass, Sistema::datos()->sistemaFindOrFail()->plant_sis_rest_pass, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_restablecimiento_de_password') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_restablecimiento_de_password') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO COTIZACIONES') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_terminos_y_condiciones">{{ __('Plantilla por default "Términos y condiciones"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_terminos_y_condiciones', $plantillas_cot_term_cond, Sistema::datos()->sistemaFindOrFail()->plant_cot_term_cond, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_terminos_y_condiciones') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_terminos_y_condiciones') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO VENTAS') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_registrar_pedido">{{ __('Plantilla por default "Registrar pedido"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_registrar_pedido', $plantillas_vent_reg_ped, Sistema::datos()->sistemaFindOrFail()->plant_vent_reg_ped, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_registrar_pedido') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_registrar_pedido') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_pedido_cancelado">{{ __('Plantilla por default "Pedido cancelado"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_pedido_cancelado', $plantillas_vent_ped_can, Sistema::datos()->sistemaFindOrFail()->plant_vent_ped_can, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_pedido_cancelado') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_pedido_cancelado') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO PAGOS') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_registrar_pago">{{ __('Plantilla por default "Registrar pago"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_registrar_pago', $plantillas_pag_reg_pag, Sistema::datos()->sistemaFindOrFail()->plant_pag_reg_pag, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_registrar_pago') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_registrar_pago') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_pago_rechazado">{{ __('Plantilla por default "Pago rechazado"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_pago_rechazado', $plantillas_pag_pag_rech, Sistema::datos()->sistemaFindOrFail()->plant_pag_pag_rech, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_pago_rechazado') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_pago_rechazado') }}</span>
      </div>
    </div>
  </div>
  <label for="redes_sociales">{{ __('MÓDULO FACTURACIÓN') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_factura_generada">{{ __('Plantilla por default "Factura generada"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_factura_generada', $plantillas_fac_generada, Sistema::datos()->sistemaFindOrFail()->plant_fac_generada, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_factura_generada') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_factura_generada') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_factura_cancelada">{{ __('Plantilla por default "Factura cancelada"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_factura_cancelada', $plantillas_fac_cancelado, Sistema::datos()->sistemaFindOrFail()->plant_fac_cancelado, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_factura_cancelada') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_factura_cancelada') }}</span>
      </div>
    </div>
  </div>
  <label for="modulo_logistica">{{ __('MÓDULO LOGÍSTICA') }}</label>
  <div class="border border-secondary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="plantilla_por_default_pedido_entregado">{{ __('Plantilla por default "Pedido entregado"') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-brush"></i></span>
          </div>
          {!! Form::select('plantilla_por_default_pedido_entregado', $plantillas_plant_ped_ent, Sistema::datos()->sistemaFindOrFail()->plant_ped_ent, ['class' => 'form-control select2' . ($errors->has('plantilla_por_default_pedido_entregado') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla_por_default_pedido_entregado') }}</span>
      </div>
    </div>
  </div>
</div>
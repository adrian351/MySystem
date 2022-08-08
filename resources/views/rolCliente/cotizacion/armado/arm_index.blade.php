<div class="card card-secondary card-outline">
  <div class="card-body">
      @include('rolCliente.cotizacion.armado.arm_table')
    <div class="form-group row justify-content-end p-0 m-0">
      <label for="sub_total">{{ __('CANT. TOTAL') }}</label>
      <div class="col-sm-1">
        <div class="input-group">
          {{ Sistema::dosDecimales($cotizacion->tot_arm) }}
        </div>
      </div>
    </div>
    @if($cotizacion->desc > 0)
      <div class="form-group row justify-content-end p-0 m-0">
        <label for="descuento">{{ __('DESCUENTO') }}</label>
        <div class="col-sm-1">
          <div class="input-group">
            ${{ Sistema::dosDecimales($cotizacion->desc) }}
          </div>
        </div>
      </div>
    @endif
    <div class="form-group row justify-content-end p-0 m-0">
      <label for="sub_total">{{ __('COST. ENVIO') }}</label>
      <div class="col-sm-1">
        <div class="input-group">
          ${{ Sistema::dosDecimales($cotizacion->cost_env) }}
        </div>
      </div>
    </div>
    <div class="form-group row justify-content-end p-0 m-0">
      <label for="sub_total">{{ __('SUBTOTAL') }}</label>
      <div class="col-sm-1">
        <div class="input-group">
          ${{ Sistema::dosDecimales($cotizacion->sub_total) }}
        </div>
      </div>
    </div>
    @if(Request::route()->getName() == 'cotizacion.edit')
      {!! Form::open(['route' => ['cotizacion.updateIva', Crypt::encrypt($cotizacion->id)], 'method' => 'patch', 'id' => 'cotizacionUpdateIva']) !!}
        <div class="form-group row justify-content-end p-0 m-0">    
          <div class="custom-control custom-switch">
            {!! Form::checkbox('iva', 'on', $cotizacion->con_iva, ['id' => 'iva', 'class' => 'custom-control-input' . ($errors->has('iva') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
            <label class="custom-control-label" for="iva">{{ __('IVA') }}</label>
          </div>
          <div class="col-sm-1">
            <div class="input-group">
              ${{ Sistema::dosDecimales($cotizacion->iva) }}
            </div>
          </div>      
        </div>
        <span class="text-danger">{{ $errors->first('iva') }}</span>
      {!! Form::close() !!}
      @if($cotizacion->con_iva == 'on')
        {!! Form::open(['route' => ['cotizacion.updateComision', Crypt::encrypt($cotizacion->id)], 'method' => 'patch', 'id' => 'cotizacionUpdateComision']) !!}
          <div class="form-group row justify-content-end p-0 m-0">
            <div class="custom-control custom-switch">
              {!! Form::checkbox('comision', 'on', $cotizacion->con_com, ['id' => 'comision', 'class' => 'custom-control-input' . ($errors->has('comision') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
              <label class="custom-control-label" for="comision">{{ __('COM. (5%)') }}</label>
            </div>
            <div class="col-sm-1">
              <div class="input-group">
                ${{ Sistema::dosDecimales($cotizacion->com) }}
              </div>
            </div>      
          </div>
          <span class="text-danger">{{ $errors->first('comision') }}</span>
        {!! Form::close() !!}
      @endif
    @else
      <div class="form-group row justify-content-end p-0 m-0">   
        <label for="iva">{{ __('IVA') }}</label>
        <div class="col-sm-1">
          <div class="input-group">
            ${{ Sistema::dosDecimales($cotizacion->iva) }}
          </div>
        </div>
      </div>
      <div class="form-group row justify-content-end p-0 m-0">   
        <label for="comisión">{{ __('COM. (5%)') }}</label>
        <div class="col-sm-1">
          <div class="input-group">
            ${{ Sistema::dosDecimales($cotizacion->com) }}
          </div>
        </div>
      </div>
    @endif
    <div class="form-group row justify-content-end p-0 m-0">
      <label for="total">{{ __('TOTAL') }}</label>
      <div class="col-sm-1">
        <div class="input-group">
          ${{ Sistema::dosDecimales($cotizacion->tot) }}
        </div>
      </div>
    </div>
  </div>
</div>
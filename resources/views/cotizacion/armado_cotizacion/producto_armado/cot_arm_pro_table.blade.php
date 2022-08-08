<span class="text-danger">{{ $errors->first('cantidad_producto') }}</span>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          <th>{{ __('CANT.') }}</th>
          @include('almacen.producto.alm_pro_table.th.sku')
          @include('almacen.producto.alm_pro_table.th.producto')
          
          @include('almacen.producto.alm_pro_table.th.costoArmado')
          @include('almacen.producto.alm_pro_table.th.precioProveedor')
          <th>{{ __('UTIL.') }}</th>
          @include('almacen.producto.alm_pro_table.th.precioCliente')
          @include('almacen.producto.alm_pro_table.th.subTotal')
          @include('almacen.producto.alm_pro_table.th.alto')
          @include('almacen.producto.alm_pro_table.th.ancho')
          @include('almacen.producto.alm_pro_table.th.largo')
          @include('almacen.producto.alm_pro_table.th.peso')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          <tr title="{{ $producto->sku }}">
            <td>
              @if(Request::route()->getName() == 'cotizacion.armado.edit')
                {!! Form::open(['route' => ['cotizacion.armado.producto.updateCantidad', Crypt::encrypt($producto->id), Crypt::encrypt($armado->id)  ], 'method' => 'patch', 'id' => 'cotizacionArmadoProductoUpdateCantidad']) !!}
                  {!! Form::select('cantidad_producto', config('opcionesSelect.select_cantidad_table_productos_edit'), $producto->cant, ['class' => 'form-control form-control-sm' . ($errors->has('cantidad_producto') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
                {!! Form::close() !!}
              @else
              {{ $producto->cant }}
              @endif
            </td>
            @include('almacen.producto.alm_pro_table.td.sku')
            @include('almacen.producto.alm_pro_table.td.producto', ['id_producto' => Crypt::encrypt($producto->id_producto), 'target' => '_blank'])
            @include('almacen.producto.alm_pro_table.td.costoArmado')
            @include('almacen.producto.alm_pro_table.td.precioProveedor')
            <td>
              @if(Request::route()->getName() == 'cotizacion.armado.edit')
                {!! Form::open(['route' => ['cotizacion.armado.producto.updateUtilidad', Crypt::encrypt($producto->id), Crypt::encrypt($armado->id)  ], 'method' => 'patch', 'id' => 'cotizacionArmadoProductoUpdateUtilidad']) !!}
                  {!! Form::select('utilidad', config('opcionesSelect.select_utilidad_sin_seleccione'), $producto->utilid, ['class' => 'form-control form-control-sm' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
                {!! Form::close() !!}
              @else
                {{ $producto->utilid }}
              @endif
            </td>
            @include('almacen.producto.alm_pro_table.td.precioCliente')
            @include('almacen.producto.alm_pro_table.td.subTotal')
            @include('almacen.producto.alm_pro_table.td.alto')
            @include('almacen.producto.alm_pro_table.td.ancho')
            @include('almacen.producto.alm_pro_table.td.largo')
            @include('almacen.producto.alm_pro_table.td.peso')
            @if(Request::route()->getName() == 'cotizacion.armado.edit')
              @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_tableOpciones')
            @else
              <td></td>
            @endif
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          @include('almacen.producto.alm_pro_table.th.id')
          <th>{{ __('CANT.') }}</th>
          @include('almacen.producto.alm_pro_table.th.producto')
          @include('almacen.producto.alm_pro_table.th.proveedor')
          @include('almacen.producto.alm_pro_table.th.precioProveedor')
          <th>{{ __('UTIL.') }}</th>
          @include('almacen.producto.alm_pro_table.th.precioCliente')
          @include('almacen.producto.alm_pro_table.th.alto')
          @include('almacen.producto.alm_pro_table.th.ancho')
          @include('almacen.producto.alm_pro_table.th.largo')
          @include('almacen.producto.alm_pro_table.th.peso')

          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          <tr title="{{ $producto->sku }}" class="{{ empty($producto->stock < $producto->min_stock) ? '' : 'bg-warning' }}">
            @include('almacen.producto.alm_pro_table.td.id')
            <td>
              @if(Request::route()->getName() == 'armado.edit' OR Request::route()->getName() == 'armado.clon.edit')
                @canany(['armado.producto.editCantidad', 'armado.clon.producto.editCantidad'])
                  {!! Form::open(['route' => ['armado.producto.editCantidad', Crypt::encrypt($producto->id), Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'armadoProductoEditCantidad']) !!}
                    {!! Form::select('cantidad', config('opcionesSelect.select_cantidad_table_productos_edit'), $producto->pivot->cant, ['class' => 'form-control form-control-sm' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'onchange' => 'this.form.submit()']) !!}
                  {!! Form::close() !!}
                @else
                  {{ $producto->pivot->cant }}
                @endcanany
              @else
              {{ Sistema::dosDecimales($producto->pivot->cant) }}
              @endif
            </td>
            @include('almacen.producto.alm_pro_table.td.producto', ['id_producto' => Crypt::encrypt($producto->id), 'target' => '_blank'])
            @include('almacen.producto.alm_pro_table.td.proveedor')
            @include('almacen.producto.alm_pro_table.td.precioProveedor')
            <td>
              {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $producto->utilid, ['class' => 'form-control form-control-sm disable' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'disabled']) !!}
            </td>
            @include('almacen.producto.alm_pro_table.td.precioCliente')
            @include('almacen.producto.alm_pro_table.td.alto')
            @include('almacen.producto.alm_pro_table.td.ancho')
            @include('almacen.producto.alm_pro_table.td.largo')
            @include('almacen.producto.alm_pro_table.td.peso')
            @if(Request::route()->getName() == 'armado.edit' OR Request::route()->getName() == 'armado.clon.edit')
              @include('armado.producto_armado.arm_proArm_tableOpciones')
            @else
              <td width="1rem"></td>
              <td width="1rem"></td>
            @endif
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>
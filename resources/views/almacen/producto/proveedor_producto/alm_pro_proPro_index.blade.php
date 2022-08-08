<div class="card {{ config('app.color_card_secundario') }}card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @can('almacen.producto.proveedor.create')
      @if(Request::route()->getName() == 'almacen.producto.edit')
        <div class="float-right">
          <a href="{{ route('almacen.producto.proveedor.create', Crypt::encrypt($producto->id)) }}" class="btn btn-primary">{{ __('Registrar proveedor') }}</a>
        </div>
      @endif
    @endcan
    <h5>{{ __('Proveedores') }}</h5> 
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_table')
    </div>
    @include('global.paginador.paginador', ['paginar' => $proveedores])
  </div>
</div>
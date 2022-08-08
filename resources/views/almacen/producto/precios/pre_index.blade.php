<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @if(Request::route()->getName() == 'almacen.producto.edit')
      <div class="float-right">
        <a href="{{ route('almacen.producto.precio.create', Crypt::encrypt($producto->id)) }}" class="btn btn-primary">{{ __('Registrar precio por año') }}</a>
      </div>
    @endif
    <h5>{{ __('Precios por año') }}</h5> 
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 15em;"> 
      @include('almacen.producto.precios.pre_table')
    </div>
    @include('global.paginador.paginador', ['paginar' => $precios])
  </div>
</div>
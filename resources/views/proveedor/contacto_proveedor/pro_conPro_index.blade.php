<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @can('proveedor.contacto.create')
      @if(Request::route()->getName() == 'proveedor.edit')
        <a href="{{ route('proveedor.contacto.create', Crypt::encrypt($proveedor->id)) }}" class="btn btn-primary btn-sm float-right">{{ __('Registrar contacto o sucursal') }}</a>
      @endif
    @endcan
    <h5>{{ __('Contactos') }}</h5> 
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => [Request::is('proveedor/editar/*') ? 'proveedor.edit' : 'proveedor.show', Crypt::encrypt($proveedor->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route(Request::is('proveedor/editar/*') ? 'proveedor.edit' : 'proveedor.show', Crypt::encrypt($proveedor->id)), 'opciones_buscador' => config('opcionesSelect.select_contactos_proveedor_index')])
    {!! Form::close() !!}
    @include('proveedor.contacto_proveedor.pro_conPro_table')
    @include('global.paginador.paginador', ['paginar' => $contactos])  
  </div>
</div>
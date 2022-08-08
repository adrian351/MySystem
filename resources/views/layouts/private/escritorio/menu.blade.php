@canany(['logs.index',
'sistema.edit',
'manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy', 
'sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy', 
'sistema.notificacion.create', 
'sistema.actividad.index',
'sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy',
'sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy',
'qys.index', 'qys.create', 'qys.show',
'usuario.index', 'usuario.create', 'usuario.show', 'usuario.edit', 'usuario.destroy',
'cliente.index', 'cliente.create', 'cliente.show', 'cliente.edit', 'cliente.destroy',
'marca.index','marca.create','marca.edit','marca.destroy',
'categoria.index','categoria.create','categoria.edit','categoria.destroy',
'subCategoria.index','subCategoria.create','subCategoria.edit','subCategoria.destroy',
'etiqueta.index','etiqueta.create','etiqueta.show','etiqueta.edit','etiqueta.destroy',
'papeleraDeReciclaje.index', 'papeleraDeReciclaje.destroy', 'papeleraDeReciclaje.restore',
'almacen.nota.create', 'almacen.nota.edit', 'almacen.nota.show', 'almacen.nota.generar', 'almacen.nota.descargar'])
  <li class="nav-header">{{ __('SISTEMA') }}</li>
@endcanany
@include('layouts.private.escritorio.menu.logs')
@include('layouts.private.escritorio.menu.jobs')
@include('layouts.private.escritorio.menu.sistema')
@include('layouts.private.escritorio.menu.quejasYSugerencias')
@include('layouts.private.escritorio.menu.categorias')
@include('layouts.private.escritorio.menu.subCategorias')
@include('layouts.private.escritorio.menu.etiquetas')
@include('layouts.private.escritorio.menu.marcas')
@include('layouts.private.escritorio.menu.usuarios')
@include('layouts.private.escritorio.menu.clientes')
@include('layouts.private.escritorio.menu.roles')
@include('layouts.private.escritorio.menu.papeleraDeReciclaje')
<!-- ****************************************************************************************** -->
@if(auth()->user()->hasRole(config('app.rol_cliente')))
  @include('layouts.private.escritorio.menu.rolCliente.cotizaciones')
  @include('layouts.private.escritorio.menu.rolCliente.pedidos')
  @include('layouts.private.escritorio.menu.rolCliente.pagos')
  @include('layouts.private.escritorio.menu.rolCliente.facturas')
  @include('layouts.private.escritorio.menu.rolCliente.comprobantes')
@endif
<!-- ****************************************************************************************** -->
@if(auth()->user()->hasRole(config('app.rol_ferro')))
  @include('layouts.private.escritorio.menu.rolFerro.rutas')
  @include('layouts.private.escritorio.menu.rolFerro.envios')
@endif
<!-- ****************************************************************************************** -->
@canany([
  'produccion.pedidoActivo.index', 'produccion.pedidoActivo.show', 'produccion.pedidoActivo.edit', 'produccion.pedidoActivo.armado.show', 'produccion.pedidoActivo.armado.edit',
  'produccion.pedidoTerminado.index','produccion.pedidoTerminado.show',
  'venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit',
  'venta.pedidoTerminado.index', 'venta.pedidoTerminado.show',
  'rastrea.pedido.show', 'rastrea.pedido.showFull',
  'pago.fPedido.index', 'pago.fPedido.create', 'pago.fPedido.show', 'pago.fPedido.edit',
  'pago.index', 'pago.show', 'pago.edit', 'pago.destroy', 'pago.marcarComoFacturado',
  'costoDeEnvio.index', 'costoDeEnvio.create', 'costoDeEnvio.show', 'costoDeEnvio.edit', 'costoDeEnvio.destroy',
  'cotizacion.index', 'cotizacion.create', 'cotizacion.show', 'cotizacion.edit', 'cotizacion.destroy',
  'proveedor.index', 'proveedor.create', 'proveedor.show', 'proveedor.edit', 'proveedor.destroy', 'proveedor.editValidado', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.show', 'proveedor.contacto.edit', 'proveedor.contacto.destroy',
  'armado.index', 'armado.create', 'armado.show', 'armado.edit', 'armado.catalogo.select','armado.destroy', 'armado.clon.index', 'armado.clon.create', 'armado.clon.show', 'armado.clon.edit', 'armado.clon.destroy', 'armado.producto.store', 'armado.producto.destroy', 'armado.producto.editCantidad', 'armado.clon.producto.store', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad',
  'almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.destroy',
  'almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit',
  'almacen.pedidoTerminado.index','almacen.pedidoTerminado.show',
  'logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit',
  'logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega',
  'logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega',
  'logistica.pedidoEntregado.index','logistica.pedidoEntregado.show',
  'logistica.direccionLocal.edit', 'logistica.direccionForaneo.edit',
  'logistica.direccionEntregada.edit',
  'factura.index', 'factura.create', 'factura.show', 'factura.edit', 'factura.destroy',
  'material.index', 'material.create', 'material.show', 'material.edit', 'material.destroy', 'material.consultarPrecio',
  'soporte.index', 'soporte.show', 'soporte.edit', 'soporte.destroy', 
  'inventario.index', 'inventario.create', 'inventario.show', 'inventario.edit', 'inventario.destroy',
  'stock.index', 'stock.create', 'stock.show', 'stock.edit', 'stock.destroy', 'almacen.nota.create', 'almacen.nota.edit', 'almacen.nota.show', 'almacen.nota.generar', 'almacen.nota.descargar'
])
  <li class="nav-header">{{ __('MÓDULOS') }}</li>
@endcanany
@include('layouts.private.escritorio.menu.proveedores')
@include('layouts.private.escritorio.menu.armados')
@include('layouts.private.escritorio.menu.costosDeEnvio')
@include('layouts.private.escritorio.menu.cotizaciones')
@include('layouts.private.escritorio.menu.rastrear')
@include('layouts.private.escritorio.menu.ventas')
@include('layouts.private.escritorio.menu.pagos')
@include('layouts.private.escritorio.menu.almacen')
@include('layouts.private.escritorio.menu.produccion')
@include('layouts.private.escritorio.menu.logistica')
@include('layouts.private.escritorio.menu.facturacion')
@include('layouts.private.escritorio.menu.tecnologiaDeLaInformacion')

{{--  modulo stocks  --}}
{{-- @include('layouts.private.escritorio.menu.stock') --}}
{{-- @include('layouts.private.escritorio.menu.material')
--}}
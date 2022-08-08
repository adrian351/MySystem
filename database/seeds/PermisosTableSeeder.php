<?php
use Illuminate\Database\Seeder;

class PermisosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
// PERMISOS DEL MÓDULO LOGS




    Spatie\Permission\Models\Permission::create([
      'id'              => 1,
      'nom'             => "Navegar por tabla Logs",
      'name'            => 'logs.index',
      'desc'            => "Lista y navega por todos los registros del módulo Logs",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA
// SISTEMA (SISTEMA)
    Spatie\Permission\Models\Permission::create([
      'id'              => 2,
      'nom'             => "Editar información 'Sistema'",
      'name'            => 'sistema.edit',
      'desc'            => "Editar información del sistema módulo 'Sistema'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA (PLANTILLAS)
    Spatie\Permission\Models\Permission::create([
      'id'              => 3,
      'nom'             => "Navegar por tabla 'Sistema (Plantillas)'",
      'name'            => 'sistema.plantilla.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Sistema (Plantillas)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 4,
      'nom'             => "Registrar nuevo 'Sistema (Plantillas)'",
      'name'			    	=> 'sistema.plantilla.create',
      'desc'            => "Crear nuevo registro en el módulo 'Sistema (Plantillas)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 5,
      'nom'             => "Ver detalles 'Sistema (Plantillas)'",
      'name'				    => 'sistema.plantilla.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Sistema (Plantillas)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 6,
      'nom'             => "Editar registro 'Sistema (Plantillas)'",
      'name'				    => "sistema.plantilla.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Sistema (Plantillas)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 7,
      'nom'             => "Eliminar registro 'Sistema (Plantillas)'",
      'name'				    => "sistema.plantilla.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Sistema (Plantillas)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA (ENVIAR NOTIFICACION)
    Spatie\Permission\Models\Permission::create([
      'id'              => 8,
      'nom'             => "Enviar notificación 'Sistema (Enviar notificación)'",
      'name'				    => 'sistema.notificacion.create',
      'desc'            => "Enviar una notificación módulo 'Sistema (Enviar notificación)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA (REGISTRO DE ACTIVIDADES)
    Spatie\Permission\Models\Permission::create([
      'id'              => 9,
      'nom'             => "Navegar por tabla 'Sistema (Registro de actividades)'",
      'name'				    => 'sistema.actividad.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Sistema (Registro de actividades)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA (CATÁLOGOS)
    Spatie\Permission\Models\Permission::create([
      'id'              => 10,
      'nom'             => "Navegar por tabla Sistema 'Catálogos'",
      'name'				    => 'sistema.catalogo.index',
      'desc'            => "Lista y navega por todos los registros del módulo Sistema 'Catálogos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 11,
      'nom'             => "Registrar nuevo Sistema 'Catálogos'",
      'name'				    => 'sistema.catalogo.create',
      'desc'            => "Crear nuevo registro en el módulo Sistema 'Catálogos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 12,
      'nom'             => "Ver detalles Sistema 'Catálogos'",
      'name'				    => 'sistema.catalogo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Sistema 'Catálogos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 13,
      'nom'             => "Editar registro Sistema 'Catálogos'",
      'name'				    => "sistema.catalogo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Sistema 'Catálogos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 14,
      'nom'             => "Eliminar registro Sistema 'Catálogos'",
      'name'				    => "sistema.catalogo.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Sistema 'Catálogos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SISTEMA (SERIES)
    Spatie\Permission\Models\Permission::create([
      'id'              => 15,
      'nom'             => "Navegar por tabla Sistema 'Series'",
      'name'				    => 'sistema.serie.index',
      'desc'            => "Lista y navega por todos los registros del módulo Sistema 'Series'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 16,
      'nom'             => "Registrar nuevo Sistema 'Series'",
      'name'				    => 'sistema.serie.create',
      'desc'            => "Crear nuevo registro en el módulo Sistema 'Series'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 17,
      'nom'             => "Ver detalles Sistema 'Series'",
      'name'				    => 'sistema.serie.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Sistema 'Series'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 18,
      'nom'             => "Editar registro Sistema 'Series'",
      'name'				    => "sistema.serie.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Sistema 'Series'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 19,
      'nom'             => "Eliminar registro Sistema 'Series'",
      'name'				    => "sistema.serie.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Sistema 'Series'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO QUEJAS Y SUGERENCIAS
    Spatie\Permission\Models\Permission::create([
      'id'              => 20,
      'nom'             => "Navegar por tabla 'Quejas y sugerencias'",
      'name'				    => 'qys.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Quejas y sugerencias'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 21,
      'nom'             => "Registrar nuevo 'Quejas y sugerencias'",
      'name'				    => 'qys.create',
      'desc'            => "Crear nuevo registro en el módulo 'Quejas y sugerencias'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 22,
      'nom'             => "Ver detalles 'Quejas y sugerencias'",
      'name'				    => 'qys.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Quejas y sugerencias'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO USUARIO
    Spatie\Permission\Models\Permission::create([
      'id'              => 23,
      'nom'             => "Navegar por tabla 'Usuarios'",
      'name'				    => 'usuario.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Usuarios'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 24,
      'nom'             => "Registrar nuevo 'Usuarios'",
      'name'				    => 'usuario.create',
      'desc'            => "Crear nuevo registro en el módulo 'Usuarios'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 25,
      'nom'             => "Ver detalles 'Usuarios'",
      'name'				    => 'usuario.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Usuarios'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 26,
      'nom'             => "Editar registro 'Usuarios'",
      'name'				    => "usuario.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Usuarios'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 27,
      'nom'             => "Eliminar registro 'Usuarios'",
      'name'				    => "usuario.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Usuarios'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO CLIENTE
    Spatie\Permission\Models\Permission::create([
      'id'              => 28,
      'nom'             => "Navegar por tabla 'Clientes'",
      'name'				    => 'cliente.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Clientes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 29,
      'nom'             => "Registrar nuevo 'Clientes'",
      'name'				    => 'cliente.create',
      'desc'            => "Crear nuevo registro en el módulo 'Clientes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 30,
      'nom'             => "Ver detalles 'Clientes'",
      'name'				    => 'cliente.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Clientes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 31,
      'nom'             => "Editar registro 'Clientes'",
      'name'				    => "cliente.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Clientes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 32,
      'nom'             => "Eliminar registro 'Clientes'",
      'name'				    => "cliente.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Clientes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ROLES
    Spatie\Permission\Models\Permission::create([
      'id'              => 33,
      'nom'             => "Navegar por tabla 'Roles'",
      'name'				    => 'rol.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Roles'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 34,
      'nom'             => "Registrar nuevo 'Roles'",
      'name'				    => 'rol.create',
      'desc'            => "Crear nuevo registro en el módulo 'Roles'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 35,
      'nom'             => "Ver detalles 'Roles'",
      'name'				    => 'rol.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Roles'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 36,
      'nom'             => "Editar registro 'Roles'",
      'name'				    => "rol.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Roles'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 37,
      'nom'             => "Eliminar registro 'Roles'",
      'name'				    => "rol.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Roles'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ROLES (PERMISOS)
    Spatie\Permission\Models\Permission::create([
      'id'              => 38,
      'nom'             => "Navegar por tabla 'Roles (Permisos)'",
      'name'				    => 'rol.permiso.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Roles (Permisos)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO (PAPELERA DE RECICLAJE)
    Spatie\Permission\Models\Permission::create([
      'id'              => 39,
      'nom'             => "Navegar por tabla 'Papelera de reciclaje'",
      'name'				    => 'papeleraDeReciclaje.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Papelera de reciclaje'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 40,
      'nom'             => "Eliminar permanentemente un registro 'Papelera de reciclaje'",
      'name'				    => "papeleraDeReciclaje.destroy",
      'desc'            => "Eliminar cualquier registro permanentemente del módulo 'Papelera de reciclaje'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      'id'              => 41,
      'nom'             => "Restaurar un registro 'Papelera de reciclaje'",
      'name'				    => 'papeleraDeReciclaje.restore',
      'desc'            => "Restaura cualquier registro del módulo 'Papelera de reciclaje'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);

/*
* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
* +++++++++++++++++++++++++++++++++++++++++ MÓDULOS
* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

// PERMISOS DEL MÓDULO (PROVEEDORES)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 41,
      'nom'             => "Navegar por tabla 'Proveedores'",
      'name'				    => 'proveedor.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 42,
      'nom'             => "Registrar nuevo 'Proveedores'",
      'name'				    => 'proveedor.create',
      'desc'            => "Crear nuevo registro en el módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 43,
      'nom'             => "Ver detalles 'Proveedores'",
      'name'				    => 'proveedor.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 44,
      'nom'             => "Editar registro 'Proveedores'",
      'name'				    => "proveedor.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 45,
      'nom'             => "Eliminar registro 'Proveedores'",
      'name'				    => "proveedor.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO PROVEEDORES (CONTACTOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 46,
      'nom'             => "Navegar por tabla Proveedores 'Contactos'",
      'name'				    => 'proveedor.contacto.index',
      'desc'            => "Lista y navega por todos los registros del módulo Proveedores 'Contactos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 47,
      'nom'             => "Registrar nuevo Proveedores 'Contactos'",
      'name'				    => 'proveedor.contacto.create',
      'desc'            => "Crear nuevo registro en el módulo Proveedores 'Contactos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 48,
      'nom'             => "Ver detalles Proveedores 'Contactos'",
      'name'				    => 'proveedor.contacto.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Proveedores 'Contactos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 49,
      'nom'             => "Editar registro Proveedores 'Contactos'",
      'name'				    => "proveedor.contacto.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Proveedores 'Contactos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 50,
      'nom'             => "Eliminar registro Proveedores 'Contactos'",
      'name'				    => "proveedor.contacto.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Proveedores 'Contactos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO (ARMADOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 51,
      'nom'             => "Navegar por tabla 'Armados'",
      'name'				    => 'armado.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 52,
      'nom'             => "Registrar nuevo 'Armados'",
      'name'				    => 'armado.create',
      'desc'            => "Crear nuevo registro en el módulo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 53,
      'nom'             => "Ver detalles 'Armados'",
      'name'				    => 'armado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 54,
      'nom'             => "Editar registro 'Armados'",
      'name'				    => "armado.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);

     // permiso para seleccionar armado de catalogo 
    //  Spatie\Permission\Models\Permission::create([
    //   // 'id'              => 1,
    //   'nom'             => "Seleccionar si un armado es de catalogo en (modulo armados)",
    //   'name'            => 'armado.catalogo.select',
    //   'desc'            => "Puede seleccionar sin un armado es de catalogo o no (armados) y puede editar ese mismo campo.",
    //   'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    // ]);

    Spatie\Permission\Models\Permission::create([
//      'id'              => 55,
      'nom'             => "Eliminar registro 'Armados'",
      'name'				    => "armado.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ARMADOS (PRODUCTOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 56,
      'nom'             => "Registrar nuevo Armados 'Productos'",
      'name'				    => 'armado.producto.create',
      'desc'            => "Crear nuevo registro en el módulo Armados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 57,
      'nom'             => "Eliminar registro Armados 'Productos'",
      'name'				    => "armado.producto.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Armados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 58,
      'nom'             => "Editar campo (Cantidad) Armados 'Productos'",
      'name'				    => "armado.producto.editCantidad",
      'desc'            => "Editar el campo (Cantidad) de un registro del módulo Armados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]); 
// PERMISOS DEL MÓDULO ARMADOS (ARMADOS CLONADOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 59,
      'nom'             => "Navegar por tabla Armados 'Armados clonados'",
      'name'				    => 'armado.clon.index',
      'desc'            => "Lista y navega por todos los registros del módulo Armados 'Armados clonados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 60,
      'nom'             => "Registrar nuevo Armados 'Armados clonados'",
      'name'				    => 'armado.clon.create',
      'desc'            => "Crear nuevo registro en el módulo Armados 'Armados clonados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 61,
      'nom'             => "Ver detalles Armados 'Armados clonados'",
      'name'				    => 'armado.clon.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Armados 'Armados clonados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 62,
      'nom'             => "Editar registro Armados 'Armados clonados'",
      'name'				    => "armado.clon.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Armados 'Armados clonados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 63,
      'nom'             => "Eliminar registro Armados 'Armados clonados'",
      'name'				    => "armado.clon.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Armados 'Armados clonados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ARMADOS/ARMADOS CLONADOS (PRODUCTOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 64,
      'nom'             => "Registrar nuevo Armados clonados 'Productos'",
      'name'				    => 'armado.clon.producto.create',
      'desc'            => "Crear nuevo registro en el módulo Armados clonados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 65,
      'nom'             => "Eliminar registro Armados clonados 'Productos'",
      'name'				    => "armado.clon.producto.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Armados clonados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 66,
      'nom'             => "Editar campo (Cantidad) Armados clonados 'Productos'",
      'name'				    => "armado.clon.producto.editCantidad",
      'desc'            => "Editar el campo (Cantidad) de un registro del módulo Armados clonados 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]); 
//PERMISOS DEL MÓDULO ALMACÉN (PEDIDO ACTIVO)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 67,
      'nom'             => "Navegar por tabla Almacén 'Pedidos activos'",
      'name'				    => 'almacen.pedidoActivo.index',
      'desc'            => "Lista y navega por todos los registros del módulo Almacén 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 68,
      'nom'             => "Ver detalles Almacén 'Pedidos activos'",
      'name'				    => 'almacen.pedidoActivo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Almacén 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 69,
      'nom'             => "Editar registro Almacén 'Pedidos activos'",
      'name'				    => "almacen.pedidoActivo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Almacén 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO ALMACÉN/PEDIDO ACTIVO (ARMADOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 71,
      'nom'             => "Ver detalles Almacén/Pedidos Activo 'Armados'",
      'name'				    => 'almacen.pedidoActivo.armado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Almacén/Pedidos Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 72,
      'nom'             => "Editar registro Almacén/Pedidos Activo 'Armados'",
      'name'				    => "almacen.pedidoActivo.armado.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Almacén/Pedidos Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ALMACÉN (PRODUCTOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 73,
      'nom'             => "Navegar por tabla Almacén 'Productos'",
      'name'				    => 'almacen.producto.index',
      'desc'            => "Lista y navega por todos los registros del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 74,
      'nom'             => "Registrar nuevo Almacén 'Productos'",
      'name'				    => 'almacen.producto.create',
      'desc'            => "Crear nuevo registro en el módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 75,
      'nom'             => "Ver detalles Almacén 'Productos'",
      'name'				    => 'almacen.producto.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 76,
      'nom'             => "Editar registro Almacén 'Productos'",
      'name'				    => "almacen.producto.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 77,
      'nom'             => "Editar campo (Disminuir stock) Almacén 'Productos'",
      'name'				    => "almacen.producto.disminuirStock",
      'desc'            => "Editar el campo (Disminuir stock) de un registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 78,
      'nom'             => "Eliminar registro Almacén 'Productos'",
      'name'				    => "almacen.producto.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ALMACÉN/PRODUCTOS (SUSTITUTOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 79,
      'nom'             => "Registrar nuevo Almacén/Productos 'Sustitutos'",
      'name'				    => 'almacen.producto.sustituto.create',
      'desc'            => "Crear nuevo registro en el módulo Almacén/Productos 'Sustitutos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 80,
      'nom'             => "Eliminar registro Almacén/Productos 'Sustitutos'",
      'name'				    => "almacen.producto.sustituto.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Almacén/Productos 'Sustitutos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ALMACÉN/PRODUCTOS (PROVEEDORES)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 81,
      'nom'             => "Registrar nuevo Almacén/Productos 'Proveedores'",
      'name'				    => 'almacen.producto.proveedor.create',
      'desc'            => "Crear nuevo registro en el módulo Almacén/Productos 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 82,
      'nom'             => "Editar registro Almacén/Productos 'Proveedores'",
      'name'				    => "almacen.producto.proveedor.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Almacén/Productos 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 83,
      'nom'             => "Eliminar registro Almacén/Productos 'Proveedores'",
      'name'			      => "almacen.producto.proveedor.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Almacén/Productos 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO VENTAS (PEDIDOS ACTIVOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 84,
      'nom'             => "Navegar por tabla Ventas 'Pedidos activos'",
      'name'				    => 'venta.pedidoActivo.index',
      'desc'            => "Lista y navega por todos los registros del módulo Ventas 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 86,
      'nom'             => "Ver detalles Ventas 'Pedidos activos'",
      'name'				    => 'venta.pedidoActivo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Ventas 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 87,
      'nom'             => "Editar registro Ventas 'Pedidos activos'",
      'name'				    => "venta.pedidoActivo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Ventas 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 88,
      'nom'             => "Eliminar registro Ventas 'Pedidos activos'",
      'name'				    => "venta.pedidoActivo.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Ventas 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO VENTAS/PEDIDOS ACTIVOS (ARMADOS)
Spatie\Permission\Models\Permission::create([
//      'id'              => 86,
    'nom'             => "Ver detalles Ventas/Pedidos activos 'Armados'",
    'name'				    => 'venta.pedidoActivo.armado.show',
    'desc'            => "Ver detalles de cualquier registro del módulo Ventas/Pedidos activos 'Armados'",
    'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
  ]);
  Spatie\Permission\Models\Permission::create([
//      'id'              => 87,
    'nom'             => "Editar registro Ventas/Pedidos activos 'Armados'",
    'name'				    => "venta.pedidoActivo.armado.edit",
    'desc'            => "Editar cualquier dato de un registro del módulo Ventas/Pedidos activos 'Armados'",
    'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
  ]);
// PERMISOS DEL MÓDULO VENTAS/PEDIDOS ACTIVOS (PAGOS)
  Spatie\Permission\Models\Permission::create([
  //      'id'              => 81,
      'nom'             => "Registrar nuevo Ventas/Pedidos activos 'Pagos'",
      'name'				    => "venta.pedidoActivo.pago.create",
      'desc'            => "Crear nuevo registro en el módulo Ventas/Pedidos activos 'Pagos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
  Spatie\Permission\Models\Permission::create([
  //      'id'              => 86,
      'nom'             => "Ver detalles Ventas/Pedidos activos 'Pagos'",
      'name'				    => "venta.pedidoActivo.pago.show",
      'desc'            => "Ver detalles de cualquier registro del módulo Ventas/Pedidos activos 'Pagos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
  //      'id'              => 87,
      'nom'             => "Editar registro Ventas/Pedidos activos 'Pagos'",
      'name'				    => "venta.pedidoActivo.pago.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Ventas/Pedidos activos 'Pagos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO VETAS (PEDIDOS TERMINADOS)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 89,
      'nom'             => "Navegar por tabla Ventas 'Pedidos terminados'",
      'name'				    => 'venta.pedidoTerminado.index',
      'desc'            => "Lista y navega por todos los registros del módulo Ventas 'Pedidos terminados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      //  'id'              => 105,
        'nom'             => "Ver detalles Ventas 'Pedidos terminados'",
        'name'				    => 'venta.pedidoTerminado.show',
        'desc'            => "Ver detalles de cualquier registro del módulo Ventas 'Pedidos terminados'",
        'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
// PERMISOS DEL MÓDULO COTIZACIONES
    Spatie\Permission\Models\Permission::create([
//      'id'              => 90,
      'nom'             => "Navegar por tabla 'Cotizaciones'",
      'name'				    => 'cotizacion.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Cotizaciones'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 91,
      'nom'             => "Registrar nuevo 'Cotizaciones'",
      'name'				    => 'cotizacion.create',
      'desc'            => "Crear nuevo registro en el módulo 'Cotizaciones'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 92,
      'nom'             => "Ver detalles 'Cotizaciones'",
      'name'				    => 'cotizacion.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Cotizaciones'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 93,
      'nom'             => "Editar registro 'Cotizaciones'",
      'name'				    => "cotizacion.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Cotizaciones'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 94,
      'nom'             => "Eliminar registro 'Cotizaciones'",
      'name'				    => "cotizacion.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Cotizaciones'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO RASTREAR PEDIDO
    Spatie\Permission\Models\Permission::create([
//      'id'              => 95,
      'nom'             => "Ver detalles Rastrear 'Pedido'",
      'name'				    => 'rastrea.pedido.show',
      'desc'            => "Ver detalles de cualquier registro a excepción de los pagos del módulo Rastrear 'Pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 96,
      'nom'             => "Ver detalles FULL Rastrear 'Pedido'",
      'name'				    => 'rastrea.pedido.showFull',
      'desc'            => "Ver detalles de cualquier registro del módulo Rastrear 'Pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO ALMACÉN (PEDIDO TERMINADO)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 97,
      'nom'             => "Navegar por tabla Almacén 'Pedidos terminados'",
      'name'				    => 'almacen.pedidoTerminado.index',
      'desc'            => "Lista y navega por todos los registros del módulo Almacén 'Pedidos terminados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 98,
      'nom'             => "Ver detalles Almacén 'Pedidos terminados'",
      'name'				    => 'almacen.pedidoTerminado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Almacén 'Pedidos terminados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);   
// PERMISOS DEL MÓDULO COSTOS DE ENVÍO
    Spatie\Permission\Models\Permission::create([
//      'id'              => 99,
      'nom'             => "Navegar por tabla 'Costos de envío'",
      'name'				    => 'costoDeEnvio.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Costos de envío'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 100,
      'nom'             => "Registrar nuevo 'Costos de envío'",
      'name'				    => 'costoDeEnvio.create',
      'desc'            => "Crear nuevo registro en el módulo 'Costos de envío'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 101,
      'nom'             => "Ver detalles 'Costos de envío'",
      'name'				    => 'costoDeEnvio.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Costos de envío'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 102,
      'nom'             => "Editar registro 'Costos de envío'",
      'name'				    => "costoDeEnvio.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Costos de envío'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 103,
      'nom'             => "Eliminar registro 'Costos de envío'",
      'name'				    => "costoDeEnvio.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Costos de envío'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);  
// PERMISOS DEL MÓDULO PAGOS (INDIVIDUAL)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 104,
      'nom'             => "Navegar por tabla Pagos 'Individual'",
      'name'				    => 'pago.index',
      'desc'            => "Lista y navega por todos los registros del módulo Pagos 'Individual'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 106,
      'nom'             => "Ver detalles Pagos 'Individual'",
      'name'				    => 'pago.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Pagos 'Individual'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 112,
      'nom'             => "Editar registro Pagos 'Individual'",
      'name'				    => "pago.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Pagos 'Individual'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 108,
      'nom'             => "Eliminar registro Pagos 'Individual'",
      'name'				    => "pago.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Pagos 'Individual'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 112,
      'nom'             => "Marcar como facturado Pagos 'Individual'",
      'name'				    => "pago.marcarComoFacturado",
      'desc'            => "Marcar como facturado e cualquier registro del módulo Pagos 'Individual'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO PAGOS (F. POR PEDIDO)
    Spatie\Permission\Models\Permission::create([
//      'id'              => 109,
      'nom'             => "Navegar por tabla Pagos 'F. por pedido'",
      'name'				    => 'pago.fPedido.index',
      'desc'            => "Lista y navega por todos los registros del módulo Pagos 'F. por pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 110,
      'nom'             => "Registrar nuevo Pagos 'F. por pedido'",
      'name'				    => 'pago.fPedido.create',
      'desc'            => "Crear nuevo registro en el módulo Pagos 'F. por pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 111,
      'nom'             => "Ver detalles Pagos 'F. por pedido'",
      'name'				    => 'pago.fPedido.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Pagos 'F. por pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 112,
      'nom'             => "Editar registro Pagos 'F. por pedido'",
      'name'				    => "pago.fPedido.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Pagos 'F. por pedido'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO FACTURACIÓN
    Spatie\Permission\Models\Permission::create([
//      'id'              => 10,
      'nom'             => "Navegar por tabla Facturación",
      'name'				    => 'factura.index',
      'desc'            => "Lista y navega por todos los registros del módulo Facturación",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 11,
      'nom'             => "Registrar nuevo Facturación",
      'name'				    => 'factura.create',
      'desc'            => "Crear nuevo registro en el módulo Facturación",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 12,
      'nom'             => "Ver detalles Facturación",
      'name'				    => 'factura.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Facturación",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 13,
      'nom'             => "Editar registro Facturación",
      'name'				    => "factura.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Facturación",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 14,
      'nom'             => "Eliminar registro Facturación",
      'name'				    => "factura.destroy",
      'desc'            => "Eliminar cualquier registro del módulo Facturación",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO PRODUCCIÓN (PEDIDO ACTIVO)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 99,
      'nom'             => "Navegar por tabla Producción 'Pedidos activos'",
      'name'				    => 'produccion.pedidoActivo.index',
      'desc'            => "Lista y navega por todos los registros del módulo Producción 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 100,
      'nom'             => "Ver detalles Producción 'Pedidos activos'",
      'name'				    => 'produccion.pedidoActivo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Producción 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 101,
      'nom'             => "Editar registro Producción 'Pedidos activos'",
      'name'				    => "produccion.pedidoActivo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Producción 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO PRODUCCIÓN/PEDIDO ACTIVO (ARMADOS)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 102,
      'nom'             => "Ver detalles Producción/Pedido Activo 'Armados'",
      'name'				    => 'produccion.pedidoActivo.armado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Producción/Pedido Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 103,
      'nom'             => "Editar registro Producción/Pedido Activo 'Armados'",
      'name'				    => "produccion.pedidoActivo.armado.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Producción/Pedido Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO PRODUCCIÓN (PEDIDO TERMINADO)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 104,
      'nom'             => "Navegar por tabla Producción 'Pedidos terminados'",
      'name'				    => 'produccion.pedidoTerminado.index',
      'desc'            => "Lista y navega por todos los registros del módulo Producción 'Pedidos terminados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 105,
      'nom'             => "Ver detalles Producción 'Pedidos terminados'",
      'name'				    => 'produccion.pedidoTerminado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Producción 'Pedidos terminados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO LOGÍSTICA (PEDIDO ACTIVO)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 99,
      'nom'             => "Navegar por tabla Logística 'Pedidos activos'",
      'name'				    => 'logistica.pedidoActivo.index',
      'desc'            => "Lista y navega por todos los registros del módulo Logística 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 100,
      'nom'             => "Ver detalles Logística 'Pedidos activos'",
      'name'				    => 'logistica.pedidoActivo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Logística 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 101,
      'nom'             => "Editar registro Logística 'Pedidos activos'",
      'name'				    => "logistica.pedidoActivo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Logística 'Pedidos activos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO LOGÍSTICA/PEDIDO ACTIVO (ARMADOS)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 102,
      'nom'             => "Ver detalles Logística/Pedido Activo 'Armados'",
      'name'				    => 'logistica.pedidoActivo.armado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Logística/Pedido Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 103,
      'nom'             => "Editar registro Logística/Pedido Activo 'Armados'",
      'name'				    => "logistica.pedidoActivo.armado.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Logística/Pedido Activo 'Armados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
   
//PERMISOS DEL MÓDULO LOGÍSTICA (DIRECCIONES LOCALES)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 104,
      'nom'             => "Navegar por tabla Logística 'Direcciones locales'",
      'name'				    => 'logistica.direccionLocal.index',
      'desc'            => "Lista y navega por todos los registros del módulo Logística 'Direcciones locales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 105,
      'nom'             => "Ver detalles Logística 'Direcciones locales'",
      'name'				    => 'logistica.direccionLocal.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Logística 'Direcciones locales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //      'id'              => 11,
      'nom'             => "Registrar nuevo comprobante de salida Logística 'Direcciones locales'",
      'name'				    => 'logistica.direccionLocal.create',
      'desc'            => "Registrar nuevo comprobante de salida en el módulo Logística 'Direcciones locales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //      'id'              => 11,
      'nom'             => "Registrar nuevo comprobante de entrega Logística 'Direcciones locales'",
      'name'				    => 'logistica.direccionLocal.createEntrega',
      'desc'            => "Registrar nuevo comprobante de entrega en el módulo Logística 'Direcciones locales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 103,
      'nom'             => "Editar registro Logística 'Direcciones locales'",
      'name'				    => "logistica.direccionLocal.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Logística 'Direcciones locales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    //PERMISOS DEL MÓDULO LOGÍSTICA (DIRECCIONES FORANEOS)
    Spatie\Permission\Models\Permission::create([
      //  'id'              => 104,
        'nom'             => "Navegar por tabla Logística 'Direcciones foraneos'",
        'name'				    => 'logistica.direccionForaneo.index',
        'desc'            => "Lista y navega por todos los registros del módulo Logística 'Direcciones foraneos'",
        'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 105,
      'nom'             => "Ver detalles Logística 'Direcciones foraneos'",
      'name'				    => 'logistica.direccionForaneo.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Logística 'Direcciones foraneos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //      'id'              => 11,
      'nom'             => "Registrar nuevo comprobante de salida Logística 'Direcciones foraneos'",
      'name'				    => 'logistica.direccionForaneo.create',
      'desc'            => "Registrar nuevo comprobante de salida en el módulo Logística 'Direcciones foraneos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //      'id'              => 11,
      'nom'             => "Registrar nuevo comprobante de entrega Logística 'Direcciones foraneos'",
      'name'				    => 'logistica.direccionForaneo.createEntrega',
      'desc'            => "Registrar nuevo comprobante de entrega en el módulo Logística 'Direcciones foraneos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //      'id'              => 11,
      'nom'             => "Registrar nuevo comprobante de entrega Logística 'Direcciones locales y foraneos'",
      'name'				    => 'logistica.direccionLocFor.createEntrega',
      'desc'            => "Registrar nuevo comprobante de entrega en el módulo Logística 'Direcciones locales y foraneos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 103,
      'nom'             => "Editar registro Logística 'Direcciones foraneos'",
      'name'				    => "logistica.direccionForaneo.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo Logística 'Direcciones foraneos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
//PERMISOS DEL MÓDULO LOGÍSTICA (PEDIDO ENTREGADO)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 104,
      'nom'             => "Navegar por tabla Logística 'Pedidos entregados'",
      'name'				    => 'logistica.pedidoEntregado.index',
      'desc'            => "Lista y navega por todos los registros del módulo Logística 'Pedidos entregados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 105,
      'nom'             => "Ver detalles Logística 'Pedidos entregados'",
      'name'				    => 'logistica.pedidoEntregado.show',
      'desc'            => "Ver detalles de cualquier registro del módulo Logística 'Pedidos entregados'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SOPORTE
    Spatie\Permission\Models\Permission::create([
//     'id'              => 99,
      'nom'             => "Navegar por tabla 'Soportes'",
      'name'            => 'soporte.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Soportes'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 100,
      'nom'             => "Ver detalles 'Soportes'",
      'name'            => 'soporte.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Soportes'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 101,
      'nom'             => "Editar regisro 'Soportes'",
      'name'            => 'soporte.edit',
      'desc'            => "Editar cualquier dato de un registro del módulo 'Soportes'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 102,
      'nom'             => "Eliminar registro 'Soportes'",
      'name'            => 'soporte.destroy',
      'desc'            => "Eliminar cualquier registro del módulo 'Soportes'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
//  PERMISOS DEL MÓDULO INVENTARIO
    Spatie\Permission\Models\Permission::create([
//      'id'              => 103,
      'nom'             => "Navegar por tabla 'Inventario'",
      'name'            => 'inventario.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Inventario'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //'id'              => 104,
    'nom'             => "Registrar nuevo  'Inventario'",
    'name'            => 'inventario.create',
    'desc'            => "Crear nuevo registro en el módulo 'Inventario'",
    'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      //'id'              => 105,
      'nom'             => "Ver detalles  'Inventario'",
      'name'            => 'inventario.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Inventario'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      //'id'              => 106,
      'nom'             => "Editar regisro 'Inventario'",
      'name'            => 'inventario.edit',
      'desc'            => "Editar cualquier dato de un registro del módulo 'Inventario'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      //'id'              => 107,
      'nom'             => "Eliminar registro 'Inventario'",
      'name'            => 'inventario.destroy',
      'desc'            => "Eliminar cualquier registro del módulo 'Inventario'",
      'created_at_perm' => 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO MATERIALES
    Spatie\Permission\Models\Permission::create([
  //    'id'              => 23,
      'nom'             => "Navegar por tabla 'Materiales'",
      'name'				    => 'material.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
  //    'id'              => 24,
      'nom'             => "Registrar nuevo 'Materiales'",
      'name'				    => 'material.create',
      'desc'            => "Crear nuevo registro en el módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
  //    'id'              => 25,
      'nom'             => "Ver detalles 'Materiales'",
      'name'				    => 'material.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
  //    'id'              => 26,
      'nom'             => "Editar registro 'Materiales'",
      'name'				    => "material.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
  //    'id'              => 27,
      'nom'             => "Eliminar registro 'Materiales'",
      'name'				    => "material.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
      //    'id'              => 23,
      'nom'             => "Consultar precio 'Materiales'",
      'name'				    => 'material.consultarPrecio',
      'desc'            => "Consultar precio de cualquier registro del módulo 'Materiales'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    // PERMISOS DEL MÓDULO SISTEMA (MANUALES)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 3,
      'nom'             => "Navegar por tabla 'Sistema (Manuales)'",
      'name'            => 'manual.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Sistema (Manuales)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 4,
      'nom'             => "Registrar nuevo 'Sistema (Manuales)'",
      'name'			    	=> 'manual.create',
      'desc'            => "Crear nuevo registro en el módulo 'Sistema (Manuales)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 5,
      'nom'             => "Ver detalles 'Sistema (Manuales)'",
      'name'				    => 'manual.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Sistema (Manuales)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 6,
      'nom'             => "Editar registro 'Sistema (Manuales)'",
      'name'				    => "manual.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Sistema (Manuales)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 7,
      'nom'             => "Eliminar registro 'Sistema (Manuales)'",
      'name'				    => "manual.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Sistema (Manuales)'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
  // PERMISOS DEL MÓDULO (STOCK)
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 3,
      'nom'             => "Navegar por tabla 'Stock'",
      'name'            => 'stock.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Stock'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 4,
      'nom'             => "Registrar nuevo 'Stock'",
      'name'			    	=> 'stock.create',
      'desc'            => "Crear nuevo registro en el módulo 'Stock'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 5,
      'nom'             => "Ver detalles 'Stock'",
      'name'				    => 'stock.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Stock'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 6,
      'nom'             => "Editar registro 'Stock'",
      'name'				    => "stock.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Stock'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
    //  'id'              => 7,
      'nom'             => "Eliminar registro 'Stock'",
      'name'				    => "stock.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Stock'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
        'nom'             => "Regresar al estatus En Ruta Logística 'Direcciones entregadas'",
        'name'				    => 'logistica.direccionEntregada.edit',
        'desc'            => "Regresar al estatus En Ruta Logística del módulo Logística 'Direcciones entregadas'",
        'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 44,
      'nom'             => "Editar registro validado 'Proveedores'",
      'name'				    => "proveedor.editValidado",
      'desc'            => "Editar campo validado de cualquier registro del módulo 'Proveedores'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 44,
      'nom'             => "Editar registro validado Almacén 'Productos'",
      'name'				    => "almacen.producto.editValidado",
      'desc'            => "Editar campo validado de cualquier registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Spatie\Permission\Models\Permission::create([
//      'id'              => 44,
      'nom'             => "Editar registro habilitado o deshabilitado Almacén 'Productos'",
      'name'				    => "almacen.producto.editHabilitado",
      'desc'            => "Editar campo habilitado o deshabilitado de cualquier registro del módulo Almacén 'Productos'",
      'created_at_perm'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);


  }
}
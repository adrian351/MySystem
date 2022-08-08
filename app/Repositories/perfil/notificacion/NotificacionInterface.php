<?php
namespace App\Repositories\perfil\notificacion;

interface NotificacionInterface {
    public function notificacionFindOrFail($id_notificacion);

    public function notificationFindOrFail($id_notification);
    
    public function getPagination($request);
    
    public function store($request);

    public function marcarComoVisto($request);

    public function marcarComoNoVisto($request);
}
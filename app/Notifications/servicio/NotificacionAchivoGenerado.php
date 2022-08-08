<?php
namespace App\Notifications\servicio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacionAchivoGenerado extends Notification {
    use Queueable;
    protected $archivo_generado;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($archivo_generado) {
        $this->archivo_generado = $archivo_generado;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database']; // 'database', 'mail'
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
                    ->line('La introducción a la notificación.')
                    ->action('Descargar', url('/'))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'tip'              => $this->archivo_generado->tip,
            'arch_rut'         => $this->archivo_generado->arch_rut,
            'arch_nom'         => $this->archivo_generado->arch_nom,
            'arch_nom_abrev'   => $this->archivo_generado->arch_nom_abrev
        ];
        
    }
}
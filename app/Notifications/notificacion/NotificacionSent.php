<?php
namespace App\Notifications\notificacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// Otros
use Illuminate\Support\Facades\Crypt;

class NotificacionSent extends Notification {
    use Queueable;
    protected $notificacion, $remitente, $plantilla;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificacion, $remitente) {
        $this->notificacion = $notificacion;
        $this->remitente = $remitente;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // 'database', 'mail'
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
        ->subject($this->notificacion->asunt)
        ->from($this->remitente)
        ->view(
            'diseno_notificacion.notificacion.' . $this->notificacion->id, [
              // No se definiran variables para enviar en el correo 
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'rut'       => 'perfil.notificacion.show',
            'id_reg'    => Crypt::encrypt($this->notificacion->id),
            'asunto'    => $this->notificacion->asunt,
            'text'      => $this->notificacion->sender->email_registro
        ];
    }
}

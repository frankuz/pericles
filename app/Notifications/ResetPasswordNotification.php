<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\ExternalEmailService;

class ResetPasswordNotification extends Notification
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['external-email'];
    }

    public function toExternalEmail($notifiable): array
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return [
            'destinatario' => $notifiable->getEmailForPasswordReset(),
            'asunto' => 'Restablecer contraseña para la aplicación PROMCE',
            'mensaje' => "Recibiste este correo porque solicitaste restablecer tu contraseña.<br><br>Haz clic en el siguiente enlace para continuar:\n{$resetUrl}<br><br>Este enlace expirará en 60 minutos.<br><br>Si no solicitaste este cambio, ignora este mensaje.<br><br>(Este es un mensaje automático. Por favor, no responda a este correo.)",
        ];
    }
}



// class ResetPasswordNotification extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @return array<int, string>
//      */
//     public function via(object $notifiable): array
//     {
//         return ['mail'];
//     }

//     /**
//      * Get the mail representation of the notification.
//      */
//     public function toMail(object $notifiable): MailMessage
//     {
//         return (new MailMessage)
//             ->line('The introduction to the notification.')
//             ->action('Notification Action', url('/'))
//             ->line('Thank you for using our application!');
//     }

//     /**
//      * Get the array representation of the notification.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(object $notifiable): array
//     {
//         return [
//             //
//         ];
//     }
// }

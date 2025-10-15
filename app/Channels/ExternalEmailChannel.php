<?php

namespace App\Channels;

use App\Services\ExternalEmailService;
use Illuminate\Notifications\Notification;
use Exception;

class ExternalEmailChannel
{
    protected ExternalEmailService $emailService;

    public function __construct(ExternalEmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function send($notifiable, Notification $notification): void
    {
        $data = $notification->toExternalEmail($notifiable);

        $result = $this->emailService->send(
            $data['destinatario'],
            $data['asunto'],
            $data['mensaje']
        );

        if (!$result) {
            throw new Exception('No se pudo enviar el correo electrónico');
        }
    }
}

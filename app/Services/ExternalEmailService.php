<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalEmailService
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.external_email.url');
        $this->apiKey = config('services.external_email.key');
    }

    // public function send(string $destinatario, string $asunto, string $mensaje): bool
    // {
    //     try {
    //         $response = Http::post($this->apiUrl, [
    //             'destinatario' => $destinatario,
    //             'asunto' => $asunto,
    //             'mensaje' => $mensaje,
    //             'key' => $this->apiKey,
    //         ]);

    //         $data = $response->json();

    //         if (isset($data['success']) && $data['success'] === true) {
    //             return true;
    //         }

    //         // Log del error si falla
    //         Log::error('Error al enviar email externo', [
    //             'destinatario' => $destinatario,
    //             'response' => $data,
    //         ]);

    //         return false;

    //     } catch (\Exception $e) {
    //         Log::error('Excepción al enviar email externo', [
    //             'destinatario' => $destinatario,
    //             'error' => $e->getMessage(),
    //         ]);

    //         return false;
    //     }
    // }
    public function send(string $destinatario, string $asunto, string $mensaje): bool
    {
        try {
            $payload = [
                'destinatario' => $destinatario,
                'asunto' => $asunto,
                'mensaje' => $mensaje,
                'key' => $this->apiKey,
            ];

            // Debug: ver qué estamos enviando
            Log::info('Enviando email externo', $payload);

            $response = Http::post($this->apiUrl, $payload);

            // Debug: ver qué recibimos
            Log::info('Respuesta del servidor', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            $data = $response->json();

            if (isset($data['success']) && $data['success'] === true) {
                return true;
            }

            Log::error('Error al enviar email externo', [
                'destinatario' => $destinatario,
                'response' => $data,
            ]);

            return false;

        } catch (\Exception $e) {
            Log::error('Excepción al enviar email externo', [
                'destinatario' => $destinatario,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}

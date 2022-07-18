<?php

namespace App\Services;

use Error;
use GuzzleHttp\Client;

class WhatsappService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(String $to, String $message)
    {
        $response = $this->client->request('POST', 'http://localhost:5000', [
            'headers' => [
                'ACCESS-KEY' => env('WHATSAPP_ACCESS_KEY', '')
            ],
            'json' => [
                'phone' => $to,
                'message' => $message
            ]
        ]);


        if ($response->getStatusCode() !== 200) {
            throw new Error('Failed send whatsapp message');
        }
    }
}

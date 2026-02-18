<?php

namespace App\Services\N8n;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class N8nClient
{
    public function post(string $path, array $payload, int $timeout = 30): Response
    {
        $base = rtrim(config('n8n.base_url'), '/');
        $url  = $base . '/' . ltrim($path, '/');

        return Http::timeout($timeout)->post($url, $payload);
    }
}

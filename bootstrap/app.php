<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust ngrok / reverse proxy headers (X-Forwarded-Host, X-Forwarded-Proto, etc.)
        $middleware->trustProxies(at: '*');

          // Exclude n8n callback from CSRF protection
    $middleware->validateCsrfTokens(except: [
        'agent/callback',
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

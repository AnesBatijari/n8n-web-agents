<?php

namespace App\Services\Workflows;

use App\Models\Potenzial;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PotenzialWorkflow
{
    public function start(Potenzial $potenzial): Potenzial
    {
        $jobId = (string) Str::uuid();

        $potenzial->update([
            'job_id' => $jobId,
            'status' => 'processing',
        ]);

        // n8n webhook endpoint for potenzial
        $webhookUrl = rtrim(config('n8n.base_url'), '/') . '/webhook/potenzial';

        $response = Http::timeout(30)->post($webhookUrl, [
            'job_id'       => $jobId,
            'url'          => $potenzial->url,
            'client_name'  => $potenzial->client_name,
            'language'     => $potenzial->language?->code ?? null,
            'location'     => $potenzial->location?->name ?? null,

            // adjust field name depending on your DB column
            'keywords'     => $potenzial->keywords ?? null,

            'callback_url' => route('callbacks.potenzial'),
        ]);

        if (!$response->successful()) {
            $potenzial->update([
                'status' => 'failed',
                'error_message' => 'Failed to start n8n workflow',
            ]);
        }

        return $potenzial;
    }
}

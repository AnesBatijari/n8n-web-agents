<?php

namespace App\Services\Workflows;

use App\Models\Potenzial;
use App\Models\PotenzialSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PotenzialWorkflow
{
    public function start(Potenzial $potenzial): Potenzial
    {
        $settings = PotenzialSetting::first();

        if (!$settings || !$settings->is_active) {
            $potenzial->update([
                'status' => 'failed',
                'error_message' => 'Potenzial settings are missing or inactive.',
            ]);

            return $potenzial;
        }

        if (!$settings->n8n_webhook_url) {
            $potenzial->update([
                'status' => 'failed',
                'error_message' => 'n8n webhook URL is missing in Potenzial settings.',
            ]);

            return $potenzial;
        }

        $jobId = $potenzial->job_id ?: (string) Str::uuid();
        $webhookUrl = trim($settings->n8n_webhook_url);

        $potenzial->update([
            'job_id' => $jobId,
            'status' => 'processing',
        ]);

        $payload = [
            'job_id' => $jobId,
            'url' => $potenzial->url,
            'client_name' => $potenzial->client_name,
            'language' => $potenzial->language,
            'location' => $potenzial->location,
            'keywords' => $potenzial->keywords ?: null,
            'client_comment' => $potenzial->client_comment ?: null,
            'system_prompt' => $settings->system_prompt,
            'user_prompt' => $settings->user_prompt,
            'callback_url' =>$settings->callback_url,
            'callback_token' => $settings->callback_token,
        ];

        logger()->info('Potenzial workflow request', [
            'url' => $webhookUrl,
            'payload' => $payload,
        ]);

        $response = Http::timeout(60)->post($webhookUrl, $payload);

        if (!$response->successful()) {
            $potenzial->update([
                'status' => 'failed',
                'error_message' => 'Failed to start n8n workflow. HTTP ' . $response->status() . '. Response: ' . $response->body(),
            ]);
        }

        return $potenzial;
    }
}

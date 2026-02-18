<?php

namespace App\Services\Workflows;

use App\Models\Audit;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SeoAuditWorkflow
{
    public function start(Audit $audit): Audit
    {
        $jobId = (string) Str::uuid();

        $audit->update([
            'job_id' => $jobId,
            'status' => 'processing',
        ]);

        $webhookUrl = rtrim(config('n8n.base_url'), '/') . '/webhook/small-audit';

        $response = Http::timeout(30)->post($webhookUrl, [
            'job_id'   => $jobId,
            'url'      => $audit->url,
            'language' => $audit->language?->code ?? null,
            'location' => $audit->location?->name ?? null,
            'callback_url' => route('callbacks.seo_audit'),
        ]);

        if (!$response->successful()) {
            $audit->update([
                'status' => 'failed',
                'error_message' => 'Failed to start n8n workflow',
            ]);
        }

        return $audit;
    }
}

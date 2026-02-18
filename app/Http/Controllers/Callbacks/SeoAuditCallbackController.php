<?php

namespace App\Http\Controllers\Callbacks;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;

class SeoAuditCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $token = $request->header('X-Agent-Token');
        if (config('n8n.callback_token') && $token !== config('n8n.callback_token')) {
            abort(403);
        }

        $data = $request->validate([
            'job_id'      => ['required', 'string'],
            'fileEnglish' => ['nullable', 'string'],
            'fileGerman'  => ['nullable', 'string'],
            'status'      => ['nullable', 'string'],
            'error'       => ['nullable', 'string'],
        ]);

        $audit = Audit::where('job_id', $data['job_id'])->first();

        if (!$audit) {
            return response()->json(['ok' => true, 'message' => 'Unknown job_id']);
        }

        $audit->update([
            'file_english'  => $data['fileEnglish'] ?? null,
            'file_german'   => $data['fileGerman'] ?? null,
            'status'        => $data['status'] ?? 'done',
            'error_message' => $data['error'] ?? null,
            'finished_at'   => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}

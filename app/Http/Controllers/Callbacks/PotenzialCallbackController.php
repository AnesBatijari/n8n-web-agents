<?php

namespace App\Http\Controllers\Callbacks;

use App\Http\Controllers\Controller;
use App\Models\Potenzial;
use Illuminate\Http\Request;

class PotenzialCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $token = $request->header('X-Agent-Token');
        if (config('n8n.callback_token') && $token !== config('n8n.callback_token')) {
            abort(403);
        }

        $data = $request->validate([
            'job_id'        => ['nullable', 'string'],
            'execution_id'  => ['nullable', 'string'],
            'file'          => ['nullable', 'string'],
            'status'        => ['nullable', 'string'],
            'error'         => ['nullable', 'string'],
            'message'       => ['nullable', 'string'],
        ]);

        $potenzial = null;

        if (!empty($data['job_id'])) {
            $potenzial = Potenzial::where('job_id', $data['job_id'])->first();
        }

        if (!$potenzial && !empty($data['execution_id'])) {
            $potenzial = Potenzial::where('execution_id', $data['execution_id'])->first();
        }

        if (!$potenzial) {
            return response()->json(['ok' => true, 'message' => 'Unknown job']);
        }

        $potenzial->update([
            'execution_id'  => $data['execution_id'] ?? $potenzial->execution_id,
            'file'          => $data['file'] ?? $potenzial->file,
            'status'        => $data['status'] ?? $potenzial->status,
            'error_message' => $data['error'] ?? $data['message'] ?? $potenzial->error_message,
            'finished_at'   => in_array($data['status'] ?? '', ['done', 'failed']) ? now() : $potenzial->finished_at,
        ]);

        return response()->json(['ok' => true]);
    }
}

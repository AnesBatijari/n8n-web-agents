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
            'job_id'        => ['required', 'string'],
            'file'          => ['nullable', 'string'],
            'status'        => ['nullable', 'string'],
            'error'         => ['nullable', 'string'],
        ]);

        $potenzial = Potenzial::where('job_id', $data['job_id'])->first();

        if (!$potenzial) {
            return response()->json(['ok' => true, 'message' => 'Unknown job_id']);
        }

        $potenzial->update([
            'file'          => $data['file'] ?? null,
            'status'        => $data['status'] ?? 'done',
            'error_message' => $data['error'] ?? null,
            'finished_at'   => now(),

        ]);

        return response()->json(['ok' => true]);
    }
}

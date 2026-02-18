<?php

namespace App\Http\Controllers\Callbacks;

use App\Http\Controllers\Controller;
use App\Models\Potenzial; // prilagodi ako ti se model zove drugačije
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

            // fajlovi / outputi (prilagodi šta n8n vraća)
            'fileEnglish'   => ['nullable', 'string'],
            'fileGerman'    => ['nullable', 'string'],

            // status info
            'status'        => ['nullable', 'string'],
            'error'         => ['nullable', 'string'],

            // opciono: dodatni payload ako želiš sačuvati raw rezultat
            'result'        => ['nullable'], // može biti array/string
        ]);

        $potenzial = Potenzial::where('job_id', $data['job_id'])->first();

        if (!$potenzial) {
            return response()->json(['ok' => true, 'message' => 'Unknown job_id']);
        }

        $potenzial->update([
            'file_english'  => $data['fileEnglish'] ?? null,
            'file_german'   => $data['fileGerman'] ?? null,
            'status'        => $data['status'] ?? 'done',
            'error_message' => $data['error'] ?? null,
            'finished_at'   => now(),

            // ako imaš kolonu npr. result_json (JSON) ili response_payload:
            // 'result_json' => $data['result'] ?? null,
        ]);

        return response()->json(['ok' => true]);
    }
}

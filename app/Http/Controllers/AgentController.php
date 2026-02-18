<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    public function index()
    {
        // show the form + maybe last 5 audits
        $recent = Audit::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('agent.index', compact('recent'));
    }

    public function audits()
    {
        $audits = Audit::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('audits.index', compact('audits'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
        ]);

        $jobId = (string) Str::uuid();

        // 1) Create DB record immediately
        $audit = Audit::create([
            'user_id' => auth()->id(),
            'job_id' => $jobId,
            'client_name' => $request->client_name,
            'url' => $request->url,
            'status' => 'queued',
            'started_at' => now(),
        ]);

        // 2) Trigger n8n
        $webhookUrl = rtrim(config('n8n.base_url'), '/') . '/webhook/small-audit';

        $response = Http::timeout(30)->post($webhookUrl, [
            'job_id'      => $jobId,
            'audit_id'    => $audit->id, // optional but useful
            'client_name' => $audit->client_name,
            'url'         => $audit->url,
            'user'        => auth()->user()->email,
            // also send callback url so n8n doesn't hardcode it
            'callback_url'=> route('agent.callback'),
        ]);

        if ($response->failed()) {
            $audit->update([
                'status' => 'failed',
                'error_message' => 'Failed to start workflow: ' . $response->status(),
            ]);

            return back()->with('error',
    'Failed: ' . $response->status() . ' - ' . $response->body()
);

        }

        // mark as running (optional)
        $audit->update(['status' => 'running']);

        return redirect()
            ->route('audits.index')
            ->with('success', 'Audit submitted. You’ll see the report links here once ready.');
    }

    public function callback(Request $request)
    {
        // Recommended protection:
        // In n8n HTTP Request node add header: X-Agent-Token = your token
        $token = $request->header('X-Agent-Token');
        if (config('n8n.callback_token') && $token !== config('n8n.callback_token')) {
            abort(403);
        }

        $data = $request->validate([
            'job_id'      => ['required', 'string'],
            'fileEnglish' => ['nullable', 'string'],
            'fileGerman'  => ['nullable', 'string'],
            'status'      => ['nullable', 'string'], // optional: done/failed
            'error'       => ['nullable', 'string'], // optional
        ]);

        $audit = Audit::where('job_id', $data['job_id'])->first();

        if (!$audit) {
            // Don't break n8n; just return ok
            return response()->json(['ok' => true, 'message' => 'Unknown job_id']);
        }

        $newStatus = $data['status'] ?? 'done';

        $audit->update([
            'file_english'  => $data['fileEnglish'] ?? null,
            'file_german'   => $data['fileGerman'] ?? null,
            'status'        => $newStatus,
            'error_message' => $data['error'] ?? null,
            'finished_at'   => now(),
        ]);

        // OPTIONAL: send email/slack here (Laravel Notifications)
        // $audit->user->notify(new AuditFinishedNotification($audit));

        return response()->json(['ok' => true]);
    }
}

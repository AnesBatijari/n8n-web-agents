<?php

namespace App\Http\Controllers\Workflows;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Services\N8n\Workflows\SeoAuditWorkflow;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoAuditController extends Controller
{
    public function create()
    {
        $recent = Audit::where('user_id', auth()->id())->latest()->take(5)->get();
        return view('agent.index', compact('recent'));
    }

    public function index()
    {
        $audits = Audit::where('user_id', auth()->id())->latest()->paginate(15);
        return view('audits.index', compact('audits'));
    }

    public function store(Request $request, SeoAuditWorkflow $workflow)
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
        ]);

        $audit = Audit::create([
            'user_id' => auth()->id(),
            'job_id' => (string) Str::uuid(),
            'client_name' => $request->client_name,
            'url' => $request->url,
            'status' => 'queued',
            'started_at' => now(),
        ]);

        try {
            $workflow->trigger($audit);
            $audit->update(['status' => 'running']);
        } catch (\Throwable $e) {
            $audit->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to start workflow: ' . $e->getMessage());
        }

        return redirect()->route('seo.index')
            ->with('success', 'Audit submitted. You’ll see the report links here once ready.');
    }
}

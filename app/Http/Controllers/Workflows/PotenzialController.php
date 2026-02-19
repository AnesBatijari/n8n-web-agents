<?php

namespace App\Http\Controllers\Workflows;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\Potenzial;
use App\Services\Workflows\PotenzialWorkflow;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PotenzialController extends Controller
{
    public function index()
    {
        $potenzials = Potenzial::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('potenzial.view', compact('potenzials'));
    }

    public function create()
    {
        return view('potenzial.create', [
            'locations' => Location::orderBy('location_name')->get(),
            'languages' => Language::orderBy('language_name')->get(),
        ]);
    }

    public function store(Request $request, PotenzialWorkflow $workflow)
    {
        $data = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
            'client_name' => ['required', 'string', 'max:255'],
            'location_id' => ['required', 'string'],
            'language_id' => ['required', 'string'],
            'keywords' => ['required', 'string'],
        ]);

        $potenzial = Potenzial::create([
            'user_id' => auth()->id(),
            'job_id' => (string) Str::uuid(),
            'client_name' => $data['client_name'],
            'url' => $data['url'],
            'location' => $data['location_id'], // name
            'language' => $data['language_id'], // name
            'keywords' => $data['keywords'],
            'status' => 'queued',
            'started_at' => now(),
        ]);

        try {
            $workflow->start($potenzial);
            $potenzial->update(['status' => 'running']);
        } catch (\Throwable $e) {
            $potenzial->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to start workflow: ' . $e->getMessage());
        }

        return redirect()->route('potenzial.index')
            ->with('success', 'Potenzial submitted. You’ll see the report link here once ready.');
    }
}

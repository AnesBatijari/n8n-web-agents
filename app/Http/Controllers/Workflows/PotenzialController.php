<?php

namespace App\Http\Controllers\Workflows;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\Potenzial;
use Illuminate\Http\Request;

class PotenzialController extends Controller
{

    public function index()
    {
        $potenzials = Potenzial::latest()->paginate(15);
        return view('potenzial.view', compact('potenzials'));
    }

    public function create()
    {
        return view('potenzial.create', [
            'locations' => Location::orderBy('location_name')->get(),
            'languages' => Language::orderBy('language_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
            'client_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'exists:locations,id'],
            'language' => ['required', 'exists:languages,id'],
            'keywords' => ['required', 'string'],
        ]);

        Potenzial::create($data);

        return redirect()->route('potenzial.index')->with('success', 'Potenzial workflow kreiran.');
    }
}

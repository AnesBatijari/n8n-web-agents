<?php

namespace App\Http\Controllers\WorkflowSettings;

use App\Http\Controllers\Controller;
use App\Models\PotenzialSetting;
use Illuminate\Http\Request;

class PotenzialSettingController extends Controller
{
    public function edit()
    {
        $setting = PotenzialSetting::first();

        if (!$setting) {
            $setting = PotenzialSetting::create([
                'prompt' => '',
                'n8n_webhook_url' => '',
                'callback_url' => '',
                'callback_token' => '',
                'is_active' => true,
            ]);
        }

        return view('potenzialanalyses.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'system_prompt' => ['nullable', 'string'],
            'user_prompt' => ['nullable', 'string'],
            'n8n_webhook_url' => ['nullable', 'string', 'max:2048'],
            'callback_url' => ['nullable', 'string', 'max:2048'],
            'callback_token' => ['nullable', 'string', 'max:255'],
        ]);

        $setting = PotenzialSetting::first();

        if (!$setting) {
            $setting = new PotenzialSetting();
        }

        $setting->updateOrCreate(
            ['id' => $setting->id ?? null],
            [
                'system_prompt' => $data['system_prompt'] ?? '',
                'user_prompt' => $data['user_prompt'] ?? '',
                'n8n_webhook_url' => $data['n8n_webhook_url'] ?? '',
                'callback_url' => $data['callback_url'] ?? '',
                'callback_token' => $data['callback_token'] ?? '',
                'is_active' => $request->boolean('is_active'),
            ]
        );

        return redirect()
            ->route('potenzial.settings.edit')
            ->with('success', 'Potenzial settings updated successfully.');
    }
}

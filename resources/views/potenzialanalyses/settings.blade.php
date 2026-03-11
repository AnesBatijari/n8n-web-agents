<x-layout.default>
    <div class="max-w-4xl">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Potenzial Settings</h2>

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('potenzial.settings.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">System Prompt</label>
                <textarea name="system_prompt" rows="10"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('system_prompt', $setting->system_prompt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">User Prompt Template</label>
                <textarea name="user_prompt" rows="10"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('user_prompt', $setting->user_prompt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">n8n Webhook URL</label>
                <input type="text" name="n8n_webhook_url"
                    value="{{ old('n8n_webhook_url', $setting->n8n_webhook_url) }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Callback URL</label>
                <input type="text" name="callback_url"
                    value="{{ old('callback_url', $setting->callback_url) }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Callback Token</label>
                <input type="text" name="callback_token"
                    value="{{ old('callback_token', $setting->callback_token) }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $setting->is_active) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label class="text-sm text-gray-700">Settings active</label>
            </div>

            <div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 rounded-lg bg-blue-600  font-medium hover:bg-blue-700">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layout.default>

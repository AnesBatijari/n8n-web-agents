<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Create Potenzial Workflow</h1>

        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('potenzial.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">URL</label>
                <input type="url" name="url" value="{{ old('url') }}" class="w-full rounded border px-3 py-2"
                    placeholder="https://example.com" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Name of the Client</label>
                <input type="text" name="client_name" value="{{ old('client_name') }}"
                    class="w-full rounded border px-3 py-2" placeholder="Client name" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <select id="location_id" name="location_id" class="w-full rounded border px-3 py-2" required>
                    <option value="">Select location...</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->title ?? ($location->location_name ?? $location->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Language</label>
                <select id="language_id" name="language_id" class="w-full rounded border px-3 py-2" required>
                    <option value="">Select language...</option>
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                            {{ $language->title ?? ($language->language_name ?? $language->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Keywords</label>
                <textarea name="keywords" rows="6" class="w-full rounded border px-3 py-2" placeholder="One keyword per line"
                    required>{{ old('keywords') }}</textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="rounded px-4 py-2">Create Potencial Anlyse</button>
            </div>
        </form>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#location_id', {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect('#language_id', {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

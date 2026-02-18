<x-app-layout>
    @if (session('error'))
        <div class="p-3 bg-red-100 border border-red-300 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="p-3 bg-green-100 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto p-6 space-y-6">
        <h1 class="text-2xl font-bold">SEO Audit</h1>

        <form method="POST" action="{{ route('agent.send') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Client Name</label>
                <input type="text" name="client_name" value="{{ old('client_name') }}"
                    class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Website URL</label>
                <input type="url" name="url" value="{{ old('url') }}" class="w-full border rounded p-2"
                    placeholder="https://example.com" required>
            </div>

            <x-primary-button type="submit">
                Generate Audit
            </x-primary-button>
        </form>

        @if (isset($recent) && $recent->count())
            <div class="border rounded p-4">
                <div class="font-bold mb-2">Recent audits</div>
                <div class="space-y-2">
                    @foreach ($recent as $a)
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium">{{ $a->client_name }}</div>
                                <div class="text-sm text-gray-500">{{ $a->status }} •
                                    {{ $a->created_at->diffForHumans() }}</div>
                            </div>
                            <a class="text-blue-600 underline" href="{{ route('audits.index') }}">Open</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-app-layout>

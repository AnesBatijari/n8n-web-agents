<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-4">

        @if (session('success'))
            <div class="p-3 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">Audits</h2>
            <a href="{{ route('seo.create') }}" class="text-blue-600 underline">New audit</a>
        </div>

        <div class="border rounded overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">URL</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">English</th>
                        <th class="p-3">German</th>
                        <th class="p-3">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($audits as $a)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $a->client_name }}</td>
                            <td class="p-3">
                                <a href="{{ $a->url }}" target="_blank" class="text-blue-600 underline">
                                    {{ \Illuminate\Support\Str::limit($a->url, 40) }}
                                </a>
                            </td>
                            <td class="p-3">{{ $a->status }}</td>
                            <td class="p-3">
                                @if ($a->file_english)
                                    <a href="{{ $a->file_english }}" target="_blank"
                                        class="text-blue-600 underline">Open</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="p-3">
                                @if ($a->file_german)
                                    <a href="{{ $a->file_german }}" target="_blank"
                                        class="text-blue-600 underline">Open</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="p-3 text-sm text-gray-500">{{ $a->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $audits->links() }}
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-4">

        @if (session('success'))
            <div class="p-3 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">Potenzial Analysen</h2>
            <a href="{{ route('potenzial.create') }}" class="text-blue-600 underline">New potenzial</a>
        </div>

        <div class="border rounded overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">URL</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Potenzial</th>
                        <th class="p-3">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($potenzials as $p)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $p->client_name }}</td>

                            <td class="p-3">
                                <a href="{{ $p->url }}" target="_blank" class="text-blue-600 underline">
                                    {{ \Illuminate\Support\Str::limit($p->url, 40) }}
                                </a>
                            </td>

                            <td class="p-3">{{ $p->status }}</td>

                            <td class="p-3">
                                @if ($p->file_potenzial)
                                    <a href="{{ $p->file_potenzial }}" target="_blank" class="text-blue-600 underline">
                                        Open
                                    </a>
                                @else
                                    —
                                @endif
                            </td>

                            <td class="p-3 text-sm text-gray-500">{{ $p->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                No potenzial analyses yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $potenzials->links() }}
    </div>
</x-app-layout>

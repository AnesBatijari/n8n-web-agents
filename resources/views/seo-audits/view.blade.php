<x-layout.default>
    <div class="max-w-5xl mx-auto p-6 space-y-4">

        @if (session('success'))
            <div class="p-3 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="panel">
            <livewire:audits.table />
        </div>
    </div>
</x-layout.default>

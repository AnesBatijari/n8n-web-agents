<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 text-center">
        <h2 class="text-xl font-bold mb-4">Generating report...</h2>
        <p>Please wait. This page will refresh automatically.</p>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('agent.poll', ['id' => $id]) }}";
            }, 4000);
        </script>
    </div>
</x-app-layout>

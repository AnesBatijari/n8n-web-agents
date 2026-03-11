<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]']) }}>
    {{ $slot }}
</button>

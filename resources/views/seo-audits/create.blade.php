<x-layout.default>
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
    <div class="panel">
        <div class="mb-5">
            <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center">
                <div class="sm:mb-0 mb-4">
                    <div class="text-2xl font-bold ltr:sm:text-left rtl:sm:text-right text-center">{{ __('app.SEO Audit') }}</div>
                </div>
                <a type="button" class="btn btn-primary" href="{{ route('seo.index') }}">
                    <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path opacity="0.5"
                            d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.25 12C7.25 11.5858 7.58579 11.25 8 11.25H16C16.4142 11.25 16.75 11.5858 16.75 12C16.75 12.4142 16.4142 12.75 16 12.75H8C7.58579 12.75 7.25 12.4142 7.25 12Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.25 8C7.25 7.58579 7.58579 7.25 8 7.25H16C16.4142 7.25 16.75 7.58579 16.75 8C16.75 8.41421 16.4142 8.75 16 8.75H8C7.58579 8.75 7.25 8.41421 7.25 8Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.25 16C7.25 15.5858 7.58579 15.25 8 15.25H13C13.4142 15.25 13.75 15.5858 13.75 16C13.75 16.4142 13.4142 16.75 13 16.75H8C7.58579 16.75 7.25 16.4142 7.25 16Z"
                            fill="currentColor" />
                    </svg>
                    {{ __('app.View Audits') }}
                </a>
            </div>
        </div>
        <div class="max-w-2xl mx-auto p-6 space-y-6">
            <form method="POST" action="{{ route('seo.store') }}" class="space-y-4">
                @csrf
                <div class="mb-5">
                    <label for="client_name">{{ __('app.Client Name') }}</label>
                    <input id="client_name" type="text" name="client_name" id="client_name" class="form-input"
                        placeholder="{{ __('app.Enter Client Name') }}" x-model="params.client_name" value="{{ old('client_name') }}" required />
                    <div class="text-danger mt-2" id="clientNameErr"></div>
                </div>
                <div class="mb-5">
                    <label for="url">{{ __('app.Client\'s Website') }}</label>
                    <input id="url" type="url" name="url" id="url" class="form-input"
                        placeholder="{{ __('app.Enter Client\'s Website URL') }}" x-model="params.url" value="{{ old('url') }}" required />
                    <div class="text-danger mt-2" id="urlErr"></div>
                </div>
                <x-primary-button type="submit">
                    {{ __('app.Generate Audit') }}
                </x-primary-button>
            </form>

            {{-- @if (isset($recent) && $recent->count())
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
                                <a class="text-blue-600 underline" href="{{ route('seo.index') }}">Open</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
</x-layout.default>

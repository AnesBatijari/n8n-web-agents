<div>
    <div class="mb-5">
        <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center gap-4">
            <div class="sm:mb-0 mb-4">
                <div class="text-2xl font-bold ltr:sm:text-left rtl:sm:text-right text-center">
                    {{ __('app.SEO Audits') }}
                </div>
            </div>

            <div class="flex items-center gap-3 sm:flex-row flex-col">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="{{ __('app.Search Audit') }}"
                        class="form-input py-2 ltr:pr-11 rtl:pl-11 peer min-w-[260px]"
                        wire:model.live.debounce.400ms="search"
                    />
                    <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                stroke-width="1.5" opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>

                <a class="btn btn-primary" href="{{ route('seo.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    {{ __('app.Create Audits') }}
                </a>
            </div>
        </div>
    </div>

    <div class="mt-5 panel p-0 border-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table-striped table-hover w-full">
                <thead>
                    <tr>
                        <th>{{ __('app.Client') }}</th>
                        <th>{{ __('app.Website URL') }}</th>
                        <th>{{ __('app.Status') }}</th>
                        <th>{{ __('app.Created at') }}</th>
                        <th class="!text-center">{{ __('app.Audit') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($audits as $a)
                        <tr wire:key="audit-{{ $a->id }}">
                            <td>
                                <div class="flex items-center w-max">
                                    <div>{{ $a->client_name }}</div>
                                </div>
                            </td>

                            <td>
                                <a href="{{ $a->url }}" target="_blank" class="text-primary hover:underline">
                                    {{ \Illuminate\Support\Str::limit($a->url, 40) }}
                                </a>
                            </td>

                            <td>
                                <div class="flex items-center w-max">
                                    <div>{{ $a->status }}</div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap">
                                {{ $a->created_at->format('Y-m-d H:i') }}
                            </td>

                            <td class="whitespace-nowrap text-center">
                                @if ($a->file_english)
                                    <a class="btn btn-primary" href="{{ $a->file_english }}" target="_blank">
                                        <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path opacity="0.5"
                                                d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                        {{ __('app.Preview') }}
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500 dark:text-gray-400">
                                {{ __('app.No audits found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $audits->links() }}
    </div>
</div>

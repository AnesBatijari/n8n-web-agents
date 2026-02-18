<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand: #2563eb;
            --border: rgba(15, 23, 42, 0.08);
            --hover: rgba(15, 23, 42, 0.04);
            --active: rgba(37, 99, 235, 0.08);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        {{-- SIDEBAR --}}
        <aside class="w-80 bg-white border-r shadow-sm flex flex-col" style="border-color: var(--border);">

            {{-- Top brand area --}}
            <div class="h-16 px-6 flex items-center border-b" style="border-color: var(--border);">
                <span class="text-lg font-extrabold tracking-wide">
                    {{ config('app.name', 'n8n Web Agents') }}
                </span>
            </div>

            <ul
                class="relative flex flex-col h-[calc(100vh-64px)] overflow-y-auto overflow-x-hidden px-4 py-4 space-y-2">

                {{-- SECTION: APPS (Yanduu-style bar) --}}
                <li class="-mx-4">
                    <div class="px-7 py-3 bg-gray-100 text-gray-900 uppercase font-extrabold text-sm tracking-wide">
                        Apps
                    </div>
                </li>

                {{-- Dashboard --}}
                <li>
                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="group flex items-center gap-3 px-4 py-3 rounded-lg text-[15px] font-normal text-gray-900 transition
                      {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                        <svg class="shrink-0 text-gray-400 transition group-hover:text-[var(--brand)]" width="22"
                            height="22" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.5"
                                d="M13 15.4C13 13.3258 13 12.2887 13.659 11.6444C14.318 11 15.3787 11 17.5 11C19.6213 11 20.682 11 21.341 11.6444C22 12.2887 22 13.3258 22 15.4V17.6C22 19.6742 22 20.7113 21.341 21.3556C20.682 22 19.6213 22 17.5 22C15.3787 22 14.318 22 13.659 21.3556C13 20.7113 13 19.6742 13 17.6V15.4Z"
                                fill="currentColor" />
                            <path
                                d="M2 8.6C2 10.6742 2 11.7113 2.65901 12.3556C3.31802 13 4.37868 13 6.5 13C8.62132 13 9.68198 13 10.341 12.3556C11 11.7113 11 10.6742 11 8.6V6.4C11 4.32582 11 3.28873 10.341 2.64437C9.68198 2 8.62132 2 6.5 2C4.37868 2 3.31802 2 2.65901 2.64437C2 3.28873 2 4.32582 2 6.4V8.6Z"
                                fill="currentColor" />
                            <path opacity="0.5"
                                d="M2 18.5C2 19.5872 2 20.1308 2.17127 20.5596C2.39963 21.1313 2.83765 21.5856 3.38896 21.8224C3.80245 22 4.32663 22 5.375 22H7.625C8.67337 22 9.19755 22 9.61104 21.8224C10.1624 21.5856 10.6004 21.1313 10.8287 20.5596C11 20.1308 11 19.5872 11 18.5C11 17.4128 11 16.8692 10.8287 16.4404C10.6004 15.8687 10.1624 15.4144 9.61104 15.1776C9.19755 15 8.67337 15 7.625 15H5.375C4.32663 15 3.80245 15 3.38896 15.1776C2.83765 15.4144 2.39963 15.8687 2.17127 16.4404C2 16.8692 2 17.4128 2 18.5Z"
                                fill="currentColor" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- SECTION: WORKFLOWS (Yanduu-style bar) --}}
                <li class="-mx-4 pt-1">
                    <div class="px-7 py-3 bg-gray-100 text-gray-900 uppercase font-extrabold text-sm tracking-wide">
                        Workflows
                    </div>
                </li>

                {{-- SEO Audits --}}
                <li x-data="{ open: {{ request()->routeIs('seo.*') ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="group w-full flex items-center justify-between px-4 py-3 rounded-lg text-[15px] font-normal text-gray-900 transition hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <svg class="shrink-0 text-gray-400 transition group-hover:text-[var(--brand)]"
                                width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5"
                                    d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z"
                                    fill="currentColor" />
                                <path
                                    d="M7.25 9C7.25 8.58579 7.58579 8.25 8 8.25H14.5C14.9142 8.25 15.25 8.58579 15.25 9C15.25 9.41421 14.9142 9.75 14.5 9.75H8C7.58579 9.75 7.25 9.41421 7.25 9Z"
                                    fill="currentColor" />
                            </svg>
                            <span>SEO Audits</span>
                        </div>

                        <svg class="w-4 h-4 text-gray-400 transition" :class="open ? 'rotate-90' : ''" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    {{-- Sub menu (dash style) --}}
                    <div x-show="open" x-cloak class="mt-1 space-y-1 pl-10">
                        <a wire:navigate href="{{ route('seo.create') }}"
                            class="block px-2 py-1.5 rounded-md text-sm font-normal text-gray-700 hover:bg-gray-50
                          {{ request()->routeIs('seo.create') ? 'text-[var(--brand)]' : '' }}">
                            - Create
                        </a>

                        <a wire:navigate href="{{ route('seo.index') }}"
                            class="block px-2 py-1.5 rounded-md text-sm font-normal text-gray-700 hover:bg-gray-50
                          {{ request()->routeIs('seo.index') ? 'text-[var(--brand)]' : '' }}">
                            - View
                        </a>
                    </div>
                </li>

                {{-- Potenzial --}}
                <li x-data="{ open: {{ request()->routeIs('potenzial.*') ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open"
                        class="group w-full flex items-center justify-between px-4 py-3 rounded-lg text-[15px] font-normal text-gray-900 transition hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <svg class="shrink-0 text-gray-400 transition group-hover:text-[var(--brand)]"
                                width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path d="M3 3v18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7 14l3-3 4 4 5-5" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Potenzial</span>
                        </div>

                        <svg class="w-4 h-4 text-gray-400 transition" :class="open ? 'rotate-90' : ''" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-cloak class="mt-1 space-y-1 pl-10">
                        <a wire:navigate href="{{ route('potenzial.create') }}"
                            class="block px-2 py-1.5 rounded-md text-sm font-normal text-gray-700 hover:bg-gray-50
                          {{ request()->routeIs('potenzial.create') ? 'text-[var(--brand)]' : '' }}">
                            - Create
                        </a>

                        <a wire:navigate href="{{ route('potenzial.index') }}"
                            class="block px-2 py-1.5 rounded-md text-sm font-normal text-gray-700 hover:bg-gray-50
                          {{ request()->routeIs('potenzial.index') ? 'text-[var(--brand)]' : '' }}">
                            - View
                        </a>
                    </div>
                </li>

            </ul>
        </aside>


        {{-- MAIN --}}
        <div class="flex-1 flex flex-col">

            {{-- HEADER --}}
            <header class="h-16 border-b bg-white shadow-sm flex items-center justify-between px-6"
                style="border-color: var(--border);">

                {{-- TITLE ON RIGHT --}}
                <div class="flex-1 text-right">
                    <h1 class="text-xl font-semibold text-gray-900">
                        @isset($header)
                            {{ $header }}
                        @else
                            Dashboard
                        @endisset
                    </h1>
                </div>

                {{-- PROFILE --}}
                <div class="relative" x-data="{ open: false }">

                    <button @click="open = !open"
                        class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">

                        <span>{{ auth()->user()->name }}</span>

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- dropdown opens to the LEFT + stays inside screen --}}
                    <div x-show="open" @click.outside="open = false" x-transition x-cloak
                        class="absolute left-0 mt-2 w-64 bg-white border rounded-lg shadow-lg overflow-hidden z-50"
                        style="border-color: var(--border); transform: translateX(-60%); max-width: calc(100vw - 24px);">

                        <div class="px-4 py-3 border-b bg-gray-50 text-left">
                            <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500 break-all">{{ auth()->user()->email }}</div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 text-left">
                            Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                Abmelden
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- CONTENT --}}
            <main class="flex-1 p-4 sm:p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white border rounded-2xl shadow-sm p-6" style="border-color: var(--border);">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>

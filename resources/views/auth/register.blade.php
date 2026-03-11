<x-layout.auth>
    <div x-data="auth">
        <div class="absolute inset-0">
            <img src="/assets/images/auth/background.png" alt="image" class="h-full w-full object-cover" />
        </div>

        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-4 py-6 dark:bg-[#060818] sm:px-6 lg:px-16 lg:py-10">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 hidden h-full max-h-[893px] -translate-y-1/2 lg:block" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-6 top-0 h-20 sm:h-28 md:left-[20%] md:h-32 lg:h-40" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-24 sm:h-40 lg:h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[10%] hidden lg:block" />

            <div class="relative w-full max-w-7xl rounded-md">
                <div class="relative flex w-full flex-col-reverse overflow-hidden rounded-md bg-white/40 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row">

                    <!-- Form column -->
                    <div class="flex w-full flex-col justify-center p-6 sm:p-8 md:p-10 lg:w-1/2 lg:p-12">
                        <div class="mx-auto w-full max-w-[440px]">
                            <div class="mb-8 lg:mb-10">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary sm:text-3xl md:text-4xl">
                                    {{ __('app.Sign up') }}
                                </h1>
                                <p class="text-sm font-bold leading-normal text-white-dark sm:text-base">
                                    {{ __('app.Enter your email and password to register') }}
                                </p>
                            </div>

                            <form class="space-y-5 dark:text-white" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div>
                                    <label for="name">{{ __('app.Name') }}</label>
                                    <div class="relative text-white-dark">
                                        <x-text-input
                                            id="name"
                                            class="form-input ps-10 placeholder:text-white-dark"
                                            type="text"
                                            name="name"
                                            placeholder="{{ __('app.Enter Name') }}"
                                            :value="old('name')"
                                            required
                                            autofocus
                                            autocomplete="name"
                                        />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="4.5" r="3" fill="#888EA8" />
                                                <path opacity="0.5" d="M15 13.125C15 14.989 15 16.5 9 16.5C3 16.5 3 14.989 3 13.125C3 11.261 5.68629 9.75 9 9.75C12.3137 9.75 15 11.261 15 13.125Z" fill="#888EA8" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="email">{{ __('app.Email') }}</label>
                                    <div class="relative text-white-dark">
                                        <x-text-input
                                            id="email"
                                            class="form-input ps-10 placeholder:text-white-dark"
                                            type="email"
                                            name="email"
                                            :value="old('email')"
                                            placeholder="{{ __('app.Enter Email') }}"
                                            required
                                            autocomplete="username"
                                        />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5"
                                                    d="M10.65 2.25H7.35C4.23873 2.25 2.6831 2.25 1.71655 3.23851C0.75 4.22703 0.75 5.81802 0.75 9C0.75 12.182 0.75 13.773 1.71655 14.7615C2.6831 15.75 4.23873 15.75 7.35 15.75H10.65C13.7613 15.75 15.3169 15.75 16.2835 14.7615C17.25 13.773 17.25 12.182 17.25 9C17.25 5.81802 17.25 4.22703 16.2835 3.23851C15.3169 2.25 13.7613 2.25 10.65 2.25Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M14.3465 6.02574C14.609 5.80698 14.6445 5.41681 14.4257 5.15429C14.207 4.89177 13.8168 4.8563 13.5543 5.07507L11.7732 6.55931C11.0035 7.20072 10.4691 7.6446 10.018 7.93476C9.58125 8.21564 9.28509 8.30993 9.00041 8.30993C8.71572 8.30993 8.41956 8.21564 7.98284 7.93476C7.53168 7.6446 6.9973 7.20072 6.22761 6.55931L4.44652 5.07507C4.184 4.8563 3.79384 4.89177 3.57507 5.15429C3.3563 5.41681 3.39177 5.80698 3.65429 6.02574L5.4664 7.53583C6.19764 8.14522 6.79033 8.63914 7.31343 8.97558C7.85834 9.32604 8.38902 9.54743 9.00041 9.54743C9.6118 9.54743 10.1425 9.32604 10.6874 8.97558C11.2105 8.63914 11.8032 8.14522 12.5344 7.53582L14.3465 6.02574Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="password">{{ __('app.Password') }}</label>
                                    <div class="relative text-white-dark">
                                        <x-text-input
                                            id="password"
                                            class="form-input ps-10 placeholder:text-white-dark"
                                            type="password"
                                            name="password"
                                            placeholder="{{ __('app.Enter Password') }}"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5"
                                                    d="M1.5 12C1.5 9.87868 1.5 8.81802 2.15901 8.15901C2.81802 7.5 3.87868 7.5 6 7.5H12C14.1213 7.5 15.182 7.5 15.841 8.15901C16.5 8.81802 16.5 9.87868 16.5 12C16.5 14.1213 16.5 15.182 15.841 15.841C15.182 16.5 14.1213 16.5 12 16.5H6C3.87868 16.5 2.81802 16.5 2.15901 15.841C1.5 15.182 1.5 14.1213 1.5 12Z"
                                                    fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75 6.75 12.4142 6.75 12C6.75 11.5858 6.41421 11.25 6 11.25C5.58579 11.25 5.25 11.5858 5.25 12C5.25 12.4142 5.58579 12.75 6 12.75Z" fill="currentColor" />
                                                <path d="M9 12.75C9.41421 12.75 9.75 12.4142 9.75 12C9.75 11.5858 9.41421 11.25 9 11.25C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75Z" fill="currentColor" />
                                                <path d="M12.75 12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12C11.25 11.5858 11.5858 11.25 12 11.25C12.4142 11.25 12.75 11.5858 12.75 12Z" fill="currentColor" />
                                                <path
                                                    d="M5.0625 6C5.0625 3.82538 6.82538 2.0625 9 2.0625C11.1746 2.0625 12.9375 3.82538 12.9375 6V7.50268C13.363 7.50665 13.7351 7.51651 14.0625 7.54096V6C14.0625 3.20406 11.7959 0.9375 9 0.9375C6.20406 0.9375 3.9375 3.20406 3.9375 6V7.54096C4.26488 7.51651 4.63698 7.50665 5.0625 7.50268V6Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="password_confirmation">{{ __('app.Confirm Password') }}</label>
                                    <div class="relative text-white-dark">
                                        <x-text-input
                                            id="password_confirmation"
                                            class="form-input ps-10 placeholder:text-white-dark"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="{{ __('app.Enter Confirm Password') }}"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5"
                                                    d="M1.5 12C1.5 9.87868 1.5 8.81802 2.15901 8.15901C2.81802 7.5 3.87868 7.5 6 7.5H12C14.1213 7.5 15.182 7.5 15.841 8.15901C16.5 8.81802 16.5 9.87868 16.5 12C16.5 14.1213 16.5 15.182 15.841 15.841C15.182 16.5 14.1213 16.5 12 16.5H6C3.87868 16.5 2.81802 16.5 2.15901 15.841C1.5 15.182 1.5 14.1213 1.5 12Z"
                                                    fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75 6.75 12.4142 6.75 12C6.75 11.5858 6.41421 11.25 6 11.25C5.58579 11.25 5.25 11.5858 5.25 12C5.25 12.4142 5.58579 12.75 6 12.75Z" fill="currentColor" />
                                                <path d="M9 12.75C9.41421 12.75 9.75 12.4142 9.75 12C9.75 11.5858 9.41421 11.25 9 11.25C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75Z" fill="currentColor" />
                                                <path d="M12.75 12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12C11.25 11.5858 11.5858 11.25 12 11.25C12.4142 11.25 12.75 11.5858 12.75 12Z" fill="currentColor" />
                                                <path
                                                    d="M5.0625 6C5.0625 3.82538 6.82538 2.0625 9 2.0625C11.1746 2.0625 12.9375 3.82538 12.9375 6V7.50268C13.363 7.50665 13.7351 7.51651 14.0625 7.54096V6C14.0625 3.20406 11.7959 0.9375 9 0.9375C6.20406 0.9375 3.9375 3.20406 3.9375 6V7.54096C4.26488 7.51651 4.63698 7.50665 5.0625 7.50268V6Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <x-primary-button class="w-full justify-center">
                                    {{ __('app.Register') }}
                                </x-primary-button>
                            </form>

                            <div class="relative my-7 text-center md:mb-9">
                                <span class="absolute inset-x-0 top-1/2 h-px w-full -translate-y-1/2 bg-white-light dark:bg-white-dark"></span>
                            </div>

                            <div class="text-center dark:text-white">
                                {{ __('app.Already have an account?') }}
                                <a href="{{ route('login') }}" class="uppercase text-primary underline transition hover:text-black dark:hover:text-white">
                                    {{ __('app.Sign in') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image column -->
                    <div class="flex w-full items-center justify-center lg:w-1/2">
                        <div class="flex w-full items-center justify-center overflow-hidden lg:h-full">
                            <img
                                src="/assets/images/auth/robot.png"
                                alt="image"
                                class="h-[220px] w-full object-cover sm:h-[300px] md:h-[380px] lg:h-full"
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout.auth>

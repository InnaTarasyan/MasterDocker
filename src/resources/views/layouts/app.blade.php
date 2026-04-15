<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Docker Learning Platform')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-full bg-slate-100 text-slate-800 antialiased">
    @php
        $links = [
            ['label' => 'Home', 'route' => 'home'],
            ['label' => 'Learn', 'route' => 'learn.index'],
            ['label' => 'Roadmap', 'route' => 'roadmap'],
            ['label' => 'Cheatsheet', 'route' => 'cheatsheet'],
            ['label' => 'Projects', 'route' => 'projects'],
        ];
    @endphp

    <div class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur dark:border-slate-800 dark:bg-slate-950/95">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-sky-700 dark:text-sky-300">Docker Laravel Academy</a>
                <button id="menuToggle" type="button" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 lg:hidden dark:border-slate-700 dark:text-slate-200">
                    Menu
                </button>
                <nav id="topNav" class="hidden items-center gap-1 text-sm lg:flex">
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="rounded-md px-3 py-2 font-medium transition {{ request()->routeIs($link['route']) ? 'bg-sky-100 text-sky-700 dark:bg-slate-800 dark:text-sky-300' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <button id="darkModeToggle" class="ml-1 rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800" type="button">
                        Theme
                    </button>
                </nav>
            </div>
            <div id="mobileNav" class="hidden border-t border-slate-200 bg-white px-4 py-3 lg:hidden dark:border-slate-800 dark:bg-slate-950">
                <div class="grid gap-2 text-sm">
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="rounded-md px-3 py-2 font-medium {{ request()->routeIs($link['route']) ? 'bg-sky-100 text-sky-700 dark:bg-slate-800 dark:text-sky-300' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <button id="darkModeToggleMobile" class="rounded-md border border-slate-300 px-3 py-2 text-left text-xs font-semibold text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800" type="button">
                        Toggle theme
                    </button>
                </div>
            </div>
        </header>

        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[260px_minmax(0,1fr)] lg:px-8">
            <aside class="h-fit rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:sticky lg:top-24 dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-xs font-semibold uppercase tracking-[0.16em] text-sky-700 dark:text-sky-300">Learning Menu</h2>
                <ul class="mt-4 space-y-1 text-sm">
                    @foreach ($links as $link)
                        <li>
                            <a
                                href="{{ route($link['route']) }}"
                                class="block rounded-md px-3 py-2 {{ request()->routeIs($link['route']) ? 'bg-sky-100 font-semibold text-sky-700 dark:bg-slate-800 dark:text-sky-300' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}"
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 rounded-lg bg-slate-50 p-3 text-xs text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                    Follow the lessons in order for a smoother learning path, then use the cheatsheet during daily development.
                </div>
            </aside>

            <main class="min-w-0 space-y-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            const key = 'docker-learning-theme';
            const root = document.documentElement;
            const preferred = localStorage.getItem(key);
            if (preferred === 'dark') {
                root.classList.add('dark');
            }

            const applyTheme = () => {
                const isDark = root.classList.contains('dark');
                localStorage.setItem(key, isDark ? 'dark' : 'light');
            };

            const toggleTheme = () => {
                root.classList.toggle('dark');
                applyTheme();
            };

            document.querySelectorAll('#darkModeToggle, #darkModeToggleMobile').forEach((toggle) => {
                toggle.addEventListener('click', toggleTheme);
            });

            const menuToggle = document.getElementById('menuToggle');
            const mobileNav = document.getElementById('mobileNav');
            if (menuToggle && mobileNav) {
                menuToggle.addEventListener('click', () => {
                    mobileNav.classList.toggle('hidden');
                });
            }

            document.querySelectorAll('[data-copy]').forEach((button) => {
                button.addEventListener('click', async () => {
                    const code = button.closest('[data-copy-block]')?.querySelector('code')?.innerText ?? '';
                    if (!code) {
                        return;
                    }

                    await navigator.clipboard.writeText(code);
                    const old = button.innerText;
                    button.innerText = 'Copied';
                    setTimeout(() => (button.innerText = old), 1000);
                });
            });
        })();
    </script>
</body>
</html>

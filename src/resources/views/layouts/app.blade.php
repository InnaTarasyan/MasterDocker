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
<body class="min-h-full bg-[#f1f1f1] text-slate-800 antialiased">
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
        <header class="sticky top-0 z-50 border-b border-[#1d1f29] bg-[#282A35] shadow-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-white">Docker Laravel Academy</a>
                <button id="menuToggle" type="button" class="rounded-md border border-slate-500 px-3 py-2 text-sm font-medium text-slate-100 lg:hidden">
                    Menu
                </button>
                <nav id="topNav" class="hidden items-center gap-1 text-sm lg:flex">
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="rounded-md px-3 py-2 font-medium transition {{ request()->routeIs($link['route']) ? 'bg-[#04AA6D] text-white' : 'text-slate-100 hover:bg-[#3a3d4a]' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <button id="darkModeToggle" class="ml-1 rounded-md border border-slate-500 px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-[#3a3d4a]" type="button">
                        Theme
                    </button>
                </nav>
            </div>
            <div id="mobileNav" class="hidden border-t border-[#3a3d4a] bg-[#282A35] px-4 py-3 lg:hidden">
                <div class="grid gap-2 text-sm">
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="rounded-md px-3 py-2 font-medium {{ request()->routeIs($link['route']) ? 'bg-[#04AA6D] text-white' : 'text-slate-100 hover:bg-[#3a3d4a]' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <button id="darkModeToggleMobile" class="rounded-md border border-slate-500 px-3 py-2 text-left text-xs font-semibold text-slate-100 hover:bg-[#3a3d4a]" type="button">
                        Toggle theme
                    </button>
                </div>
            </div>
        </header>

        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[260px_minmax(0,1fr)] lg:px-8">
            <aside class="h-fit rounded-lg border border-slate-300 bg-white p-5 shadow-sm lg:sticky lg:top-24">
                <h2 class="text-xs font-semibold uppercase tracking-[0.16em] text-[#0b7a55]">Learning Menu</h2>
                <ul class="mt-4 space-y-1 text-sm">
                    @foreach ($links as $link)
                        <li>
                            <a
                                href="{{ route($link['route']) }}"
                                class="block rounded-md px-3 py-2 {{ request()->routeIs($link['route']) ? 'bg-[#e7f7f0] font-semibold text-[#0b7a55]' : 'text-slate-700 hover:bg-slate-100' }}"
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 rounded-lg bg-[#f7f9fa] p-3 text-xs text-slate-600">
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

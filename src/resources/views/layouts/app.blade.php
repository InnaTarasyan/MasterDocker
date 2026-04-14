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
<body class="min-h-full bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/95 backdrop-blur">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wide text-cyan-300">Docker Laravel Academy</a>
                <div class="flex items-center gap-2 text-sm">
                    @php
                        $links = [
                            ['label' => 'Home', 'route' => 'home'],
                            ['label' => 'Learn', 'route' => 'learn.index'],
                            ['label' => 'Roadmap', 'route' => 'roadmap'],
                            ['label' => 'Cheatsheet', 'route' => 'cheatsheet'],
                            ['label' => 'Projects', 'route' => 'projects'],
                        ];
                    @endphp
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="rounded-md px-3 py-2 transition {{ request()->routeIs($link['route']) ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <button id="darkModeToggle" class="ml-1 rounded-md border border-slate-700 px-3 py-2 text-xs text-slate-200 hover:border-slate-500" type="button">
                        Toggle theme
                    </button>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    <script>
        (function () {
            const key = 'docker-learning-theme';
            const root = document.documentElement;
            const preferred = localStorage.getItem(key);
            if (preferred === 'light') {
                root.classList.add('light');
                document.body.classList.remove('bg-slate-950', 'text-slate-100');
                document.body.classList.add('bg-slate-50', 'text-slate-900');
            }

            const toggle = document.getElementById('darkModeToggle');
            if (toggle) {
                toggle.addEventListener('click', () => {
                    const isLight = root.classList.toggle('light');
                    if (isLight) {
                        localStorage.setItem(key, 'light');
                        document.body.classList.remove('bg-slate-950', 'text-slate-100');
                        document.body.classList.add('bg-slate-50', 'text-slate-900');
                    } else {
                        localStorage.setItem(key, 'dark');
                        document.body.classList.remove('bg-slate-50', 'text-slate-900');
                        document.body.classList.add('bg-slate-950', 'text-slate-100');
                    }
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

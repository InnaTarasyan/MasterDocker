@extends('layouts.app')

@section('title', 'Docker Cheatsheet')

@section('content')
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Docker Cheatsheet</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-300">Quick reference for daily Docker and Laravel container workflow.</p>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-sky-700 dark:text-sky-300">Docker Commands</h2>
            <div class="mt-4 space-y-3">
                @foreach ($cheatsheet['docker_commands'] as $command)
                    <div data-copy-block class="rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-950">
                        <div class="mb-2 flex justify-end">
                            <button data-copy type="button" class="rounded border border-slate-300 px-2 py-1 text-xs text-slate-700 hover:border-sky-500 hover:text-sky-700 dark:border-slate-600 dark:text-slate-300 dark:hover:border-sky-500 dark:hover:text-sky-300">Copy</button>
                        </div>
                        <code class="text-sm text-emerald-700 dark:text-emerald-300">{{ $command }}</code>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-sky-700 dark:text-sky-300">Laravel Docker ENV</h2>
            <div class="mt-4 space-y-3">
                @foreach ($cheatsheet['laravel_env'] as $env)
                    <div data-copy-block class="rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-950">
                        <div class="mb-2 flex justify-end">
                            <button data-copy type="button" class="rounded border border-slate-300 px-2 py-1 text-xs text-slate-700 hover:border-sky-500 hover:text-sky-700 dark:border-slate-600 dark:text-slate-300 dark:hover:border-sky-500 dark:hover:text-sky-300">Copy</button>
                        </div>
                        <code class="text-sm text-amber-700 dark:text-amber-300">{{ $env }}</code>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-sky-700 dark:text-sky-300">Compose Patterns</h2>
            <ul class="mt-4 list-inside list-disc space-y-3 text-slate-600 dark:text-slate-300">
                @foreach ($cheatsheet['compose_patterns'] as $pattern)
                    <li>{{ $pattern }}</li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection

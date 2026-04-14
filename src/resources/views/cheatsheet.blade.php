@extends('layouts.app')

@section('title', 'Docker Cheatsheet')

@section('content')
    <h1 class="text-3xl font-bold">Docker Cheatsheet</h1>
    <p class="mt-2 text-slate-300">Quick reference for daily Docker and Laravel container workflow.</p>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
            <h2 class="text-lg font-semibold text-cyan-300">Docker Commands</h2>
            <div class="mt-4 space-y-3">
                @foreach ($cheatsheet['docker_commands'] as $command)
                    <div data-copy-block class="rounded-lg border border-slate-700 bg-slate-950 p-3">
                        <div class="mb-2 flex justify-end">
                            <button data-copy type="button" class="rounded border border-slate-600 px-2 py-1 text-xs text-slate-300 hover:border-cyan-400 hover:text-cyan-300">Copy</button>
                        </div>
                        <code class="text-sm text-emerald-300">{{ $command }}</code>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
            <h2 class="text-lg font-semibold text-cyan-300">Laravel Docker ENV</h2>
            <div class="mt-4 space-y-3">
                @foreach ($cheatsheet['laravel_env'] as $env)
                    <div data-copy-block class="rounded-lg border border-slate-700 bg-slate-950 p-3">
                        <div class="mb-2 flex justify-end">
                            <button data-copy type="button" class="rounded border border-slate-600 px-2 py-1 text-xs text-slate-300 hover:border-cyan-400 hover:text-cyan-300">Copy</button>
                        </div>
                        <code class="text-sm text-amber-300">{{ $env }}</code>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
            <h2 class="text-lg font-semibold text-cyan-300">Compose Patterns</h2>
            <ul class="mt-4 list-inside list-disc space-y-3 text-slate-300">
                @foreach ($cheatsheet['compose_patterns'] as $pattern)
                    <li>{{ $pattern }}</li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection

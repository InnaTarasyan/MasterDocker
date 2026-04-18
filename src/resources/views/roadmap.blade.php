@extends('layouts.app')

@section('title', 'Docker Roadmap')

@section('content')
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Docker Learning Roadmap</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-300">Track your progress from beginner concepts to production-ready Laravel Docker architecture.</p>
    </section>

    <div class="space-y-6">
        @foreach ($roadmap as $group)
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-xl font-semibold text-sky-700 dark:text-sky-300">{{ $group['level'] }}</h2>
                <div class="mt-4 grid gap-4">
                    @foreach ($group['steps'] as $step)
                        <article class="rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-700 dark:bg-slate-800/70">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ $step['title'] }}</h3>
                                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $step['description'] }}</p>
                                </div>
                                <label class="inline-flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                                    <input type="checkbox" class="roadmap-status h-4 w-4 rounded border-slate-300 bg-white dark:border-slate-600 dark:bg-slate-900" data-roadmap-id="{{ $step['slug'] }}">
                                    Completed
                                </label>
                            </div>
                            @if ($step['can_view'])
                                <a href="{{ route('learn.show', $step['slug']) }}" class="mt-3 inline-flex text-sm font-medium text-sky-700 hover:text-sky-600 dark:text-sky-300">Go to lesson</a>
                            @else
                                <p class="mt-3 inline-flex rounded bg-amber-100 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-amber-700">
                                    Locked (sign in to unlock advanced lessons)
                                </p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>

    <script>
        (function () {
            const key = 'docker-roadmap-progress';
            const state = JSON.parse(localStorage.getItem(key) || '{}');
            document.querySelectorAll('.roadmap-status').forEach((input) => {
                input.checked = !!state[input.dataset.roadmapId];
                input.addEventListener('change', () => {
                    state[input.dataset.roadmapId] = input.checked;
                    localStorage.setItem(key, JSON.stringify(state));
                });
            });
        })();
    </script>
@endsection

@extends('layouts.app')

@section('title', 'Docker Roadmap')

@section('content')
    <section>
        <h1 class="text-3xl font-bold">Docker Learning Roadmap</h1>
        <p class="mt-2 text-slate-300">Track your progress from beginner concepts to production-ready Laravel Docker architecture.</p>
    </section>

    <div class="mt-8 space-y-6">
        @foreach ($roadmap as $group)
            <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-6">
                <h2 class="text-xl font-semibold text-cyan-300">{{ $group['level'] }}</h2>
                <div class="mt-4 grid gap-4">
                    @foreach ($group['steps'] as $step)
                        <article class="rounded-lg border border-slate-700 bg-slate-800/50 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-white">{{ $step['title'] }}</h3>
                                    <p class="mt-1 text-sm text-slate-300">{{ $step['description'] }}</p>
                                </div>
                                <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                                    <input type="checkbox" class="roadmap-status h-4 w-4 rounded border-slate-600 bg-slate-900" data-roadmap-id="{{ $step['slug'] }}">
                                    Completed
                                </label>
                            </div>
                            <a href="{{ route('learn.show', $step['slug']) }}" class="mt-3 inline-flex text-sm font-medium text-cyan-300 hover:text-cyan-200">Go to lesson</a>
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

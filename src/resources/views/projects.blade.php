@extends('layouts.app')

@section('title', 'Docker Project Examples')

@section('content')
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Project Examples</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-300">Real-world Docker setups you can adapt for Laravel development and deployment.</p>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">
        @foreach ($projects as $project)
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-sky-700 dark:text-sky-300">{{ $project['title'] }}</h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $project['description'] }}</p>
                <div data-copy-block class="mt-4 rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-950">
                    <div class="mb-2 flex justify-end">
                        <button data-copy type="button" class="rounded border border-slate-300 px-2 py-1 text-xs text-slate-700 hover:border-sky-500 hover:text-sky-700 dark:border-slate-600 dark:text-slate-300 dark:hover:border-sky-500 dark:hover:text-sky-300">Copy</button>
                    </div>
                    <pre class="overflow-x-auto text-xs text-emerald-700 dark:text-emerald-300"><code>{{ $project['snippet'] }}</code></pre>
                </div>
                <a href="{{ route('learn.index') }}" class="mt-4 inline-flex text-sm font-medium text-sky-700 hover:text-sky-600 dark:text-sky-300">View details in lessons</a>
            </article>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Docker Project Examples')

@section('content')
    <h1 class="text-3xl font-bold">Project Examples</h1>
    <p class="mt-2 text-slate-300">Real-world Docker setups you can adapt for Laravel development and deployment.</p>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        @foreach ($projects as $project)
            <article class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
                <h2 class="text-lg font-semibold text-cyan-300">{{ $project['title'] }}</h2>
                <p class="mt-2 text-sm text-slate-300">{{ $project['description'] }}</p>
                <div data-copy-block class="mt-4 rounded-lg border border-slate-700 bg-slate-950 p-3">
                    <div class="mb-2 flex justify-end">
                        <button data-copy type="button" class="rounded border border-slate-600 px-2 py-1 text-xs text-slate-300 hover:border-cyan-400 hover:text-cyan-300">Copy</button>
                    </div>
                    <pre class="overflow-x-auto text-xs text-emerald-300"><code>{{ $project['snippet'] }}</code></pre>
                </div>
                <a href="{{ route('learn.index') }}" class="mt-4 inline-flex text-sm font-medium text-cyan-300 hover:text-cyan-200">View details in lessons</a>
            </article>
        @endforeach
    </div>
@endsection

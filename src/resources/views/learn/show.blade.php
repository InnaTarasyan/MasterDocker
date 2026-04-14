@extends('layouts.app')

@section('title', $lesson['title'])

@section('content')
    <div class="grid gap-8 lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="h-fit rounded-xl border border-slate-800 bg-slate-900/70 p-4 lg:sticky lg:top-24">
            <h2 class="px-2 text-sm font-semibold uppercase tracking-wider text-cyan-300">Topics</h2>
            <ul class="mt-3 space-y-1">
                @foreach ($lessons as $item)
                    <li>
                        <a href="{{ route('learn.show', $item['slug']) }}" class="block rounded-md px-3 py-2 text-sm {{ $activeSlug === $item['slug'] ? 'bg-cyan-500/20 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <article class="space-y-6">
            <h1 class="text-4xl font-bold">{{ $lesson['title'] }}</h1>

            <section class="rounded-xl border border-cyan-800/50 bg-cyan-950/20 p-5">
                <h2 class="text-lg font-semibold text-cyan-200">Introduction</h2>
                <p class="mt-2 text-slate-200">{{ $lesson['intro'] }}</p>
            </section>

            <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
                <h2 class="text-lg font-semibold">Key Concepts</h2>
                <ul class="mt-3 list-inside list-disc space-y-2 text-slate-300">
                    @foreach ($lesson['key_concepts'] as $concept)
                        <li>{{ $concept }}</li>
                    @endforeach
                </ul>
                <div class="mt-4 grid gap-3 md:grid-cols-2">
                    @foreach ($lesson['definitions'] as $definition)
                        @php $term = array_key_first($definition); @endphp
                        <div class="rounded-lg border border-slate-700 bg-slate-800/60 p-3 text-sm">
                            <p class="font-semibold text-cyan-300">{{ $term }}</p>
                            <p class="mt-1 text-slate-300">{{ $definition[$term] }}</p>
                        </div>
                    @endforeach
                </div>
                <p class="mt-4 text-sm text-slate-400">Highlights: <span class="font-medium text-slate-200">{{ implode(' | ', $lesson['highlights']) }}</span></p>
            </section>

            <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
                <h2 class="text-lg font-semibold">Visual Comparison</h2>
                <div class="mt-4 overflow-hidden rounded-lg border border-slate-700">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-800 text-cyan-300">
                            <tr>
                                <th class="px-3 py-2">{{ $lesson['comparison']['headers'][0] }}</th>
                                <th class="px-3 py-2">{{ $lesson['comparison']['headers'][1] }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lesson['comparison']['rows'] as $row)
                                <tr class="border-t border-slate-700">
                                    <td class="px-3 py-2 text-slate-200">{{ $row[0] }}</td>
                                    <td class="px-3 py-2 text-slate-300">{{ $row[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-5">
                <h2 class="text-lg font-semibold">Code Examples</h2>
                <div class="mt-4 space-y-3">
                    @foreach ($lesson['commands'] as $command)
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
                <h2 class="text-lg font-semibold">How it works internally</h2>
                <ol class="mt-3 list-inside list-decimal space-y-2 text-slate-300">
                    @foreach ($lesson['internal_steps'] as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            </section>

            <section class="rounded-xl border border-indigo-800/50 bg-indigo-950/20 p-5">
                <h2 class="text-lg font-semibold text-indigo-200">Laravel Connection</h2>
                <ul class="mt-3 list-inside list-disc space-y-2 text-slate-300">
                    @foreach ($lesson['laravel_connection'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="rounded-xl border border-rose-800/50 bg-rose-950/20 p-5">
                <h2 class="text-lg font-semibold text-rose-200">Common Mistakes</h2>
                <ul class="mt-3 list-inside list-disc space-y-2 text-slate-300">
                    @foreach ($lesson['common_mistakes'] as $mistake)
                        <li>{{ $mistake }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="rounded-xl border border-emerald-800/50 bg-emerald-950/20 p-5">
                <h2 class="text-lg font-semibold text-emerald-200">Summary</h2>
                <p class="mt-2 text-slate-200">{{ $lesson['summary'] }}</p>
            </section>

            @if ($nextLesson)
                <a href="{{ route('learn.show', $nextLesson['slug']) }}" class="inline-flex rounded-md bg-cyan-500 px-5 py-3 font-semibold text-slate-900 hover:bg-cyan-400">
                    Next lesson: {{ $nextLesson['title'] }}
                </a>
            @endif
        </article>
    </div>
@endsection

@extends('layouts.app')

@section('title', $lesson['title'])

@section('content')
    <article class="space-y-6">
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-white">{{ $lesson['title'] }}</h1>
            <p class="mt-3 text-slate-600 dark:text-slate-300">{{ $lesson['intro'] }}</p>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Key Concepts</h2>
            <ul class="mt-3 list-inside list-disc space-y-2 text-slate-600 dark:text-slate-300">
                @foreach ($lesson['key_concepts'] as $concept)
                    <li>{{ $concept }}</li>
                @endforeach
            </ul>
            <div class="mt-4 grid gap-3 md:grid-cols-2">
                @foreach ($lesson['definitions'] as $definition)
                    @php $term = array_key_first($definition); @endphp
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-800">
                        <p class="font-semibold text-sky-700 dark:text-sky-300">{{ $term }}</p>
                        <p class="mt-1 text-slate-600 dark:text-slate-300">{{ $definition[$term] }}</p>
                    </div>
                @endforeach
            </div>
            <p class="mt-4 text-sm text-slate-600 dark:text-slate-400">Highlights: <span class="font-medium text-slate-800 dark:text-slate-200">{{ implode(' | ', $lesson['highlights']) }}</span></p>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Visual Comparison</h2>
            <div class="mt-4 overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-sky-300">
                        <tr>
                            <th class="px-3 py-2">{{ $lesson['comparison']['headers'][0] }}</th>
                            <th class="px-3 py-2">{{ $lesson['comparison']['headers'][1] }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lesson['comparison']['rows'] as $row)
                            <tr class="border-t border-slate-200 dark:border-slate-700">
                                <td class="px-3 py-2 text-slate-800 dark:text-slate-200">{{ $row[0] }}</td>
                                <td class="px-3 py-2 text-slate-600 dark:text-slate-300">{{ $row[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Code Examples</h2>
            <div class="mt-4 space-y-3">
                @foreach ($lesson['commands'] as $command)
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
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">How it works internally</h2>
            <ol class="mt-3 list-inside list-decimal space-y-2 text-slate-600 dark:text-slate-300">
                @foreach ($lesson['internal_steps'] as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </section>

        <section class="rounded-xl border border-indigo-200 bg-indigo-50 p-5 dark:border-indigo-900/40 dark:bg-indigo-950/20">
            <h2 class="text-lg font-semibold text-indigo-700 dark:text-indigo-200">Laravel Connection</h2>
            <ul class="mt-3 list-inside list-disc space-y-2 text-slate-700 dark:text-slate-300">
                @foreach ($lesson['laravel_connection'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>

        <section class="rounded-xl border border-rose-200 bg-rose-50 p-5 dark:border-rose-900/40 dark:bg-rose-950/20">
            <h2 class="text-lg font-semibold text-rose-700 dark:text-rose-200">Common Mistakes</h2>
            <ul class="mt-3 list-inside list-disc space-y-2 text-slate-700 dark:text-slate-300">
                @foreach ($lesson['common_mistakes'] as $mistake)
                    <li>{{ $mistake }}</li>
                @endforeach
            </ul>
        </section>

        <section class="rounded-xl border border-emerald-200 bg-emerald-50 p-5 dark:border-emerald-900/40 dark:bg-emerald-950/20">
            <h2 class="text-lg font-semibold text-emerald-700 dark:text-emerald-200">Summary</h2>
            <p class="mt-2 text-slate-700 dark:text-slate-200">{{ $lesson['summary'] }}</p>
        </section>

        @if ($nextLesson)
            <a href="{{ route('learn.show', $nextLesson['slug']) }}" class="inline-flex rounded-md bg-sky-600 px-5 py-3 font-semibold text-white hover:bg-sky-700">
                Next lesson: {{ $nextLesson['title'] }}
            </a>
        @endif
    </article>
@endsection

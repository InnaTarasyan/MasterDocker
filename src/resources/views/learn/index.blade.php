@extends('layouts.app')

@section('title', 'Learn Docker')

@section('content')
    <div class="grid gap-8 lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="h-fit rounded-xl border border-slate-800 bg-slate-900/70 p-4 lg:sticky lg:top-24">
            <h2 class="px-2 text-sm font-semibold uppercase tracking-wider text-cyan-300">Topics</h2>
            <ul class="mt-3 space-y-1">
                @foreach ($lessons as $item)
                    <li>
                        <a href="{{ route('learn.show', $item['slug']) }}" class="block rounded-md px-3 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <section>
            <h1 class="text-3xl font-bold">Docker Learning Path</h1>
            <p class="mt-3 max-w-3xl text-slate-300">Choose any lesson from the sidebar. Every lesson includes key concepts, command examples, internals, Laravel-specific guidance, common mistakes, and a quick summary.</p>
            <div class="mt-8 grid gap-4 md:grid-cols-2">
                @foreach ($lessons as $lesson)
                    <a href="{{ route('learn.show', $lesson['slug']) }}" class="rounded-xl border border-slate-800 bg-slate-900/60 p-5 transition hover:border-cyan-500">
                        <h3 class="font-semibold text-white">{{ $lesson['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ $lesson['intro'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection

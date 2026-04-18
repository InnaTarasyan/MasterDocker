@extends('layouts.app')

@section('title', 'Learn Docker')

@section('content')
    <section class="rounded-lg border border-slate-300 bg-white p-6 shadow-sm">
        <h1 class="text-3xl font-bold text-slate-900">Docker Learning Path</h1>
        <p class="mt-3 max-w-3xl text-slate-600">Study from top to bottom like a practical handbook: concept, commands, internals, Laravel connection, mistakes, and quick summary.</p>
    </section>

    <section class="rounded-lg border border-slate-300 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-slate-900">All Lessons</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
            @foreach ($lessons as $lesson)
                @if ($lesson['can_view'])
                    <a href="{{ route('learn.show', $lesson['slug']) }}" class="rounded-lg border border-slate-300 bg-slate-50 p-5 transition hover:border-[#04AA6D] hover:bg-white">
                        <h3 class="font-semibold text-slate-900">{{ $lesson['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $lesson['intro'] }}</p>
                    </a>
                @else
                    <article class="rounded-lg border border-slate-200 bg-slate-100 p-5 opacity-85">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="font-semibold text-slate-700">{{ $lesson['title'] }}</h3>
                            <span class="rounded bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">Locked</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">{{ $lesson['intro'] }}</p>
                    </article>
                @endif
            @endforeach
        </div>
    </section>
@endsection

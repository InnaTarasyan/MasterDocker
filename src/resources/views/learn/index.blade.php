@extends('layouts.app')

@section('title', 'Learn Docker')

@section('content')
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Docker Learning Path</h1>
        <p class="mt-3 max-w-3xl text-slate-600 dark:text-slate-300">Study from top to bottom like a practical handbook: concept, commands, internals, Laravel connection, mistakes, and quick summary.</p>
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">All Lessons</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-2">
            @foreach ($lessons as $lesson)
                <a href="{{ route('learn.show', $lesson['slug']) }}" class="rounded-xl border border-slate-200 bg-slate-50 p-5 transition hover:border-sky-300 hover:bg-white dark:border-slate-700 dark:bg-slate-800 dark:hover:border-sky-600">
                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ $lesson['title'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">{{ $lesson['intro'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection

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
                <a href="{{ route('learn.show', $lesson['slug']) }}" class="rounded-lg border border-slate-300 bg-slate-50 p-5 transition hover:border-[#04AA6D] hover:bg-white">
                    <h3 class="font-semibold text-slate-900">{{ $lesson['title'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $lesson['intro'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection

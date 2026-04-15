@extends('layouts.app')

@section('title', 'Master Docker with Laravel')

@section('content')
    <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-sky-700 dark:text-sky-300">Docker Learning Platform</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight text-slate-900 dark:text-white">Master Docker with Laravel</h1>
        <p class="mt-4 max-w-2xl text-slate-600 dark:text-slate-300">Step-by-step tutorials, practical commands, and production-focused examples for Dockerized Laravel apps.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('learn.index') }}" class="rounded-md bg-sky-600 px-5 py-3 font-semibold text-white hover:bg-sky-700">Start Learning</a>
            <a href="{{ route('roadmap') }}" class="rounded-md border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">View Roadmap</a>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">What is Docker?</h2>
            <ul class="mt-4 space-y-2 text-slate-600 dark:text-slate-300">
                <li>Docker packages apps with runtime and dependencies.</li>
                <li>Images create consistent environments across machines.</li>
                <li>Containers start fast and isolate processes safely.</li>
                <li>Compose runs full multi-service stacks with one command.</li>
                <li>Networking and volumes make local Laravel setups reliable.</li>
            </ul>
        </article>
        <article class="rounded-xl border border-sky-200 bg-sky-50 p-6 dark:border-slate-700 dark:bg-slate-900">
            <h3 class="text-xl font-semibold text-sky-800 dark:text-sky-300">Simple explanation</h3>
            <p class="mt-3 text-slate-700 dark:text-slate-300">Think of Docker as a shipping container for software: your Laravel app, PHP runtime, and tools are packed together so everyone runs the same stack locally and in production.</p>
        </article>
    </section>

    <section>
        <div class="mb-3 flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Learning Path Preview</h2>
            <a href="{{ route('learn.index') }}" class="text-sm font-semibold text-sky-700 hover:text-sky-600 dark:text-sky-300">View all lessons</a>
        </div>
        <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($topicPreview as $topic)
                <a href="{{ route('learn.show', $topic['slug']) }}" class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-sky-300 hover:-translate-y-0.5 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-sky-600">
                    <h3 class="font-semibold text-slate-900 group-hover:text-sky-700 dark:text-white dark:group-hover:text-sky-300">{{ $topic['title'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">{{ $topic['summary'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Why this learning structure works</h2>
        <div class="mt-4 grid gap-4 lg:grid-cols-3">
            <div class="rounded-xl border border-rose-200 bg-rose-50 p-5 dark:border-rose-900/40 dark:bg-rose-950/20">
                <h3 class="font-semibold text-rose-700 dark:text-rose-300">Without Docker</h3>
                <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">Different local versions, setup drift, and hard-to-reproduce bugs across teammates.</p>
            </div>
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5 dark:border-emerald-900/40 dark:bg-emerald-950/20">
                <h3 class="font-semibold text-emerald-700 dark:text-emerald-300">With Docker</h3>
                <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">Predictable environments, faster onboarding, and repeatable deployment builds.</p>
            </div>
            <div class="rounded-xl border border-sky-200 bg-sky-50 p-5 dark:border-sky-900/40 dark:bg-sky-950/20">
                <h3 class="font-semibold text-sky-700 dark:text-sky-300">Laravel workflow</h3>
                <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">Run Laravel, MySQL, Redis, workers, and Nginx together using Compose service discovery.</p>
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Start your Docker journey</h2>
        <p class="mt-2 text-slate-600 dark:text-slate-400">Follow guided lessons, copy runnable commands, and build production-ready Laravel stacks.</p>
        <a href="{{ route('learn.index') }}" class="mt-6 inline-flex rounded-md bg-sky-600 px-6 py-3 font-semibold text-white hover:bg-sky-700">Start Learning</a>
    </section>
@endsection

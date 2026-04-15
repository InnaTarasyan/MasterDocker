@extends('layouts.app')

@section('title', 'Master Docker with Laravel')

@section('content')
    <section class="rounded-lg border border-slate-300 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#0b7a55]">Docker Learning Platform</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">Master Docker with Laravel</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Step-by-step tutorials, practical commands, and production-focused examples for Dockerized Laravel apps.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('learn.index') }}" class="rounded-md bg-[#04AA6D] px-5 py-3 font-semibold text-white hover:bg-[#0b7a55]">Start Learning</a>
            <a href="{{ route('roadmap') }}" class="rounded-md border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100">View Roadmap</a>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <article class="rounded-lg border border-slate-300 bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-semibold text-slate-900">What is Docker?</h2>
            <ul class="mt-4 space-y-2 text-slate-600">
                <li>Docker packages apps with runtime and dependencies.</li>
                <li>Images create consistent environments across machines.</li>
                <li>Containers start fast and isolate processes safely.</li>
                <li>Compose runs full multi-service stacks with one command.</li>
                <li>Networking and volumes make local Laravel setups reliable.</li>
            </ul>
        </article>
        <article class="rounded-lg border border-[#b7ead8] bg-[#ecfbf4] p-6">
            <h3 class="text-xl font-semibold text-[#0b7a55]">Simple explanation</h3>
            <p class="mt-3 text-slate-700">Think of Docker as a shipping container for software: your Laravel app, PHP runtime, and tools are packed together so everyone runs the same stack locally and in production.</p>
        </article>
    </section>

    <section>
        <div class="mb-3 flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-slate-900">Learning Path Preview</h2>
            <a href="{{ route('learn.index') }}" class="text-sm font-semibold text-[#0b7a55] hover:text-[#04AA6D]">View all lessons</a>
        </div>
        <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($topicPreview as $topic)
                <a href="{{ route('learn.show', $topic['slug']) }}" class="group rounded-lg border border-slate-300 bg-white p-5 shadow-sm transition hover:border-[#04AA6D] hover:-translate-y-0.5">
                    <h3 class="font-semibold text-slate-900 group-hover:text-[#0b7a55]">{{ $topic['title'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $topic['summary'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold text-slate-900">Why this learning structure works</h2>
        <div class="mt-4 grid gap-4 lg:grid-cols-3">
            <div class="rounded-lg border border-rose-200 bg-rose-50 p-5">
                <h3 class="font-semibold text-rose-700">Without Docker</h3>
                <p class="mt-2 text-sm text-slate-700">Different local versions, setup drift, and hard-to-reproduce bugs across teammates.</p>
            </div>
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-5">
                <h3 class="font-semibold text-emerald-700">With Docker</h3>
                <p class="mt-2 text-sm text-slate-700">Predictable environments, faster onboarding, and repeatable deployment builds.</p>
            </div>
            <div class="rounded-lg border border-sky-200 bg-sky-50 p-5">
                <h3 class="font-semibold text-sky-700">Laravel workflow</h3>
                <p class="mt-2 text-sm text-slate-700">Run Laravel, MySQL, Redis, workers, and Nginx together using Compose service discovery.</p>
            </div>
        </div>
    </section>

    <section class="rounded-lg border border-slate-300 bg-white p-8 text-center shadow-sm">
        <h2 class="text-3xl font-bold text-slate-900">Start your Docker journey</h2>
        <p class="mt-2 text-slate-600">Follow guided lessons, copy runnable commands, and build production-ready Laravel stacks.</p>
        <a href="{{ route('learn.index') }}" class="mt-6 inline-flex rounded-md bg-[#04AA6D] px-6 py-3 font-semibold text-white hover:bg-[#0b7a55]">Start Learning</a>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Master Docker with Laravel')

@section('content')
    <section class="rounded-2xl border border-cyan-800/50 bg-gradient-to-br from-slate-900 to-slate-800 p-8 shadow-xl">
        <p class="text-sm uppercase tracking-widest text-cyan-300">Docker Learning Platform</p>
        <h1 class="mt-2 text-4xl font-bold">Master Docker with Laravel</h1>
        <p class="mt-4 max-w-2xl text-slate-300">Learn Docker from basics to production-ready Laravel setups.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('learn.index') }}" class="rounded-md bg-cyan-500 px-5 py-3 font-semibold text-slate-900 hover:bg-cyan-400">Start Learning</a>
            <a href="{{ route('roadmap') }}" class="rounded-md border border-slate-600 px-5 py-3 font-semibold text-slate-200 hover:border-cyan-400 hover:text-cyan-300">View Roadmap</a>
        </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
        <article class="rounded-xl border border-slate-800 bg-slate-900/70 p-6">
            <h2 class="text-2xl font-semibold">What is Docker?</h2>
            <ul class="mt-4 space-y-2 text-slate-300">
                <li>Docker packages apps with runtime and dependencies.</li>
                <li>Images create consistent environments across machines.</li>
                <li>Containers start fast and isolate processes safely.</li>
                <li>Compose runs full multi-service stacks with one command.</li>
                <li>Networking and volumes make local Laravel setups reliable.</li>
            </ul>
        </article>
        <article class="rounded-xl border border-cyan-800/40 bg-cyan-950/20 p-6 text-slate-200">
            <h3 class="text-xl font-semibold text-cyan-200">Simple explanation</h3>
            <p class="mt-3">Think of Docker as a shipping container for software: your Laravel app, PHP runtime, and tools are packed together so everyone runs the same stack locally and in production.</p>
        </article>
    </section>

    <section class="mt-10">
        <h2 class="text-2xl font-semibold">Learning Path Preview</h2>
        <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($topicPreview as $topic)
                <a href="{{ route('learn.show', $topic['slug']) }}" class="group rounded-xl border border-slate-800 bg-slate-900/60 p-5 transition hover:border-cyan-500">
                    <h3 class="font-semibold text-white group-hover:text-cyan-300">{{ $topic['title'] }}</h3>
                    <p class="mt-2 text-sm text-slate-400">{{ $topic['summary'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mt-10 grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-rose-900/50 bg-rose-950/20 p-5">
            <h3 class="font-semibold text-rose-300">Without Docker problems</h3>
            <p class="mt-2 text-sm text-slate-300">Different local versions, setup drift, and hard-to-reproduce bugs across teammates.</p>
        </div>
        <div class="rounded-xl border border-emerald-900/50 bg-emerald-950/20 p-5">
            <h3 class="font-semibold text-emerald-300">With Docker benefits</h3>
            <p class="mt-2 text-sm text-slate-300">Predictable environments, fast onboarding, and repeatable deployment builds.</p>
        </div>
        <div class="rounded-xl border border-cyan-900/50 bg-cyan-950/20 p-5">
            <h3 class="font-semibold text-cyan-300">Laravel use case</h3>
            <p class="mt-2 text-sm text-slate-300">Run Laravel, MySQL, Redis, queue workers, and Nginx together using Compose service discovery.</p>
        </div>
    </section>

    <section class="mt-10 rounded-2xl border border-slate-800 bg-slate-900 p-8 text-center">
        <h2 class="text-3xl font-bold">Start your Docker journey</h2>
        <p class="mt-2 text-slate-400">Follow guided lessons, copy runnable commands, and build production-ready Laravel stacks.</p>
        <a href="{{ route('learn.index') }}" class="mt-6 inline-flex rounded-md bg-cyan-500 px-6 py-3 font-semibold text-slate-900 hover:bg-cyan-400">Start Learning</a>
    </section>
@endsection

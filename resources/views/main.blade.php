@extends('layout')

@section('content')

@php
    $taskCount = 0;
    foreach ($projects as $project):
        $taskCount += count($project->tasks);
    endforeach
@endphp

<section class="max-w-screen-lg mx-auto text-white">
    {{-- top-user-info-band --}}
    <div class="main-container flex justify-between">
        <div class="secondary-container">
            <div>
                <span>Projektai:</span>
                <span class="font-bold">{{ count($projects) }}</span>
            </div>
            <div>
                <span>Užduotys:</span>
                <span class="font-bold">{{ count(Auth::user()->tasks) }} / {{ $taskCount }}</span>
            </div>
        </div>

        <div class="secondary-container">
            <div>
                {{Auth::user()->name}}
            </div>
            <div class="flex mt-[24px]">
                <a href="{{ route('user.edit.form', Auth::user()) }}">
                    <button class="primary-btn main-transition">Redaguoti profilį</button>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="ms-5">
                    @csrf
                    <button class="primary-btn bg-red-600 border-red-600 hover:text-red-800 hover:bg-white main-transition hover:border-red-600">Atsijungti</button>
                </form>
            </div>
        </div>
    </div>

    {{-- create new project button and project autput --}}
    <div class="main-container mt-6">
        <a href="{{ route('create') }}" class="mb-[36px] block">
            <button class="primary-btn main-transition">Sukurti naują projektą</button>
        </a>

        <div class="flex justify-start flex-wrap">

            @forelse ($projects as $project)
                <x-projectCard :project="$project" />
            @empty
                Projektų nėra
            @endforelse

        </div>
    </div>
</section>


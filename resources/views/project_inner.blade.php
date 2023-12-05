@extends('layout')

@section('content')

@php
    $userRole = Auth::user()->projects->find($project->id)->pivot->role;
@endphp

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">
        <a href="{{ route('main') }}" class="mb-[12px] inline-block hover:underline">
            << Į pagrindinį
        </a>

        <div class="flex justify-between">
            <div class="secondary-container bg-tertiary min-w-[140px]">
                {{-- maybe put in reusables --}}
                <div class="flex justify-center text-black">
                    <div class="bg-white project-status-bubbles w-fit px-1">{{  Auth::user()->getTaskCount($project->id) }} / {{ count($project->tasks) }}</div>
                </div>

                <x-reusables.taskBubbles :project="$project" />
            </div>
            <div class="secondary-container min-w-[140px]">
                <div>
                    <span>{{ Auth::user()->name }}: </span>
                    <span>{{ $userRole }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">

        @if ($userRole == 'admin')
            <a href="{{ route('create-task', $project) }}" class="mb-[36px] block">
                <button class="primary-btn main-transition">Sukurti naują užduotį</button>
            </a>
        @endif

        @if (session('status'))
            <span class="text-blue-400">{{ session('status') }}</span>
        @endif

        <div>
            @foreach ($project->tasks as $task)
                <x-taskCard :task="$task" />
            @endforeach
        </div>
    </div>
</section>

@endsection

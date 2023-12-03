@extends('layout')

@section('content')

@php
    $userRole = Auth::user()->projects->find($project->id)->pivot->role;
@endphp

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container flex justify-between">
        <div class="secondary-container bg-tertiary min-w-[140px]">
            {{-- maybe put in reusables --}}
            <div class="flex justify-center text-black">
                <div class="bg-white project-status-bubbles w-fit px-1">29</div>
            </div>

            <x-reusables.taskBubbles />
        </div>
        <div class="secondary-container min-w-[140px]">
            <div>
                <span>{{ Auth::user()->name }}: </span>
                <span>{{ $userRole }}</span>
            </div>
        </div>
    </div>

    <div class="main-container">
        @if ($userRole == 'admin')
            <a href="#" class="mb-[36px] block">
                <button class="primary-btn main-transition">Sukurti naują užduotį</button>
            </a>
        @endif

        <div>
            <x-taskCard />
        </div>
    </div>
</section>

@endsection

@extends('layout')

@section('content')

@php
    $userRole = Auth::user()->projects->find($project->id)->pivot->role;
@endphp

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">
        <x-reusables.breadcrumbs :project="$project" :task="$task" />

        {{-- Change task status --}}
        <div>
            <div>

            </div>

            <div>

            </div>
        </div>

        <div class="flex justify-between mb-[12px]">
            <div>
                <div><span class="small-gray-font">Prleista laiko:</span> 1:30</div>
                <div><span class="small-gray-font">Duotas laikas užduočiai:</span> {{ $task->time_estimation }}</div>
            </div>
            <div>
                <div><span class="small-gray-font">Sukurta:</span> {{ $task->created_at->format('Y-m-d') }}</div>
                <div><span class="small-gray-font">Terminas:</span> {{ $task->dead_line }}</div>
            </div>
        </div>

        <div class="secondary-container w-full">
            {!! $task->description !!}
        </div>

        <div class="flex justify-end mt-[24px]">
            <form action="{{ route('destroy-task', [$project, $task]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="danger-button">Ištrinti užduotį</button>
            </form>
        </div>
    </div>

    <div class="main-container">

        @if ($userRole == 'admin')
            <a href="{{ route('create-child-task', [$project, $task]) }}" class="mb-[36px] block">
                <button class="primary-btn main-transition">Sukurti naują užduotį</button>
            </a>
        @endif

        @if (session('status'))
            <span class="text-blue-400">{{ session('status') }}</span>
        @endif

        <div>
            @foreach ($task->children as $task)
                <x-taskCard :task="$task" />
            @endforeach
        </div>
    </div>
</section>

@endsection

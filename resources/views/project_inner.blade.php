@extends('layout')

@section('content')

@php
    $userRole = Auth::user()->projects->find($project->id)->pivot->role;
@endphp

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">

        <x-reusables.breadcrumbs :project="$project" task="null" />

        <div class="flex justify-between">
            <div class="secondary-container bg-tertiary min-w-[140px]">
                {{-- maybe put in reusables --}}
                <div class="flex justify-center text-black">
                    <div class="bg-white project-status-bubbles w-fit px-1">{{  Auth::user()->getTaskCount($project->id) }} / {{ count($project->tasks) }}</div>
                </div>

                <x-reusables.taskBubbles :project="$project" />
            </div>

            <div class="w-[75%] flex justify-end">
                <div class="">
                    <span class="inline-block text-[14px] border-2 rounded-md bg-primary whitespace-nowrap m-1 px-2 border-green-600">Rėjus Černiauskas</span>
                    <span class="inline-block text-[14px] border-2 rounded-md bg-primary whitespace-nowrap m-1 px-2 border-tertiary">Martynas sasnsaunsask</span>
                    <span class="inline-block text-[14px] border-2 rounded-md bg-primary whitespace-nowrap m-1 px-2 border-tertiary">Jonas Slekta</span>
                </div>

                {{-- assign user to project --}}
                <div class="max-w-[200px]">
                    <form action="{{ route('add-users', $project) }}" method="POST" class="text-black flex flex-col">
                        @csrf
                        <select name="users[]" id="users" multiple class="bg-secondary text-white border-primary border-2 rounded-md">
                            <option class="px-2" value="null" selected>Pasirinkti vartotojus</option>
                            <option class="px-2" value="volvo">Volvo</option>
                            <option class="px-2" value="saab">Saab</option>
                            <option class="px-2" value="vw">VW</option>
                            <option class="px-2" value="audi">Audi</option>
                        </select>

                        <button class="primary-btn main-transition mt-[12px]">Pridėti vartotojus</button>
                    </form>
                </div>

            </div>
        </div>

        <div class="mt-[24px] flex justify-end">
            <form action="{{ route('destroy-project', $project) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="danger-button">Ištrinti projektą</button>
            </form>
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
            @forelse ($project->top_level_tasks as $task)
                <x-taskCard :task="$task" />
            @empty
                Užduotys nerastos
            @endforelse
        </div>
    </div>
</section>

@endsection

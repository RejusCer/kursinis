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
                <div class="me-[12px]">
                    <div class="ms-1 font-bold">Pridėti vartotojai:</div>
                    @foreach ($project->users as $user)
                        @php
                            $userClass = 'border-tertiary';
                            if ($user->pivot->role == 'admin') {
                                $userClass = 'border-green-600';
                            }
                        @endphp

                        <span class="user-block {{ $userClass }}">{{ $user->name }}</span>
                    @endforeach
                </div>

                {{-- assign user to project --}}

                @if ( 0 != count($users = $project->free_users($project->id)))
                    <div class="max-w-[200px]">
                        <form action="{{ route('add-users', $project) }}" method="POST" class="text-black flex flex-col">
                            @csrf
                            <select name="users[]" id="users" multiple class="bg-secondary text-white border-primary border-2 rounded-md">
                                @foreach ($users as $user)
                                    <option class="px-2" value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach

                            </select>

                            <button class="primary-btn main-transition mt-[12px]">Pridėti vartotojus</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>

        @if ($userRole == 'admin')
        <div class="mt-[24px] flex justify-end">
            <form action="{{ route('destroy-project', $project) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="danger-button">Ištrinti projektą</button>
            </form>
        </div>
        @endif
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

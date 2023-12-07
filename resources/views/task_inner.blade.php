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

        <div class="mt-[12px] flex">
            @if ($userRole == 'admin' && 0 != count($notAsignedUsers = $project->users_not_in_task($task->id)))
            <div class="max-w-[200px] me-[12px]">
                <form action="{{ route('task.add_users', $task) }}" method="POST" class="text-black flex flex-col">
                    @csrf
                    <select name="users[]" id="users" multiple class="bg-secondary text-white border-primary border-2 rounded-md">
                        @foreach ($notAsignedUsers as $user)
                            <option class="px-2" value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <button class="primary-btn main-transition mt-[12px]">Pridėti vartotojus</button>
                </form>
            </div>
            @endif

            <div class="">
                <div class="ms-1 font-bold">Pridėti vartotojai:</div>
                @foreach ($task->users as $user)
                    <span class="user-block">{{ $user->name }}</span>
                @endforeach
            </div>
        </div>

        @if ($userRole == 'admin')
        <div class="flex justify-end mt-[24px]">
            <form action="{{ route('destroy-task', [$project, $task]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="danger-button">Ištrinti užduotį</button>
            </form>
        </div>
        @endif
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

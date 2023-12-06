@props([
    'project' => $project,
    'task' => $task
])

@php
    $userRole = Auth::user()->projects->find($project->id)->pivot->role;
@endphp

<div class="flex justify-between mb-[24px]">
    <div>
        <div class="small-gray-font">
            <a href="{{ route('main') }}" class="hover:underline">
                << Į pagrindinį
            </a>
            @if ($task != "null")
                <a href="{{ route('project_inner', $project) }}" class="hover:underline">
                    < {{ $project->name }}
                </a>

                @if ($parentTask = $task->parent)
                    <a href="{{ route('task_inner', [$project, $parentTask]) }}" class="hover:underline">
                        < {{ $parentTask->name }}
                    </a>
                @endif
            @endif
        </div>

        @if ($task != "null")
            <h1 class="heading-1 my-[12px]">{{ $task->name }}</h1>
        @else
            <h1 class="heading-1 my-[12px]">{{ $project->name }}</h1>
        @endif
    </div>


    <div class="secondary-container flex flex-col">
        <div>
            <span>{{ Auth::user()->name }}: </span>
            <span>{{ $userRole }}</span>
        </div>
        <div class="flex justify-end mt-[24px]">
            <form action="{{ route('logout') }}" method="POST" class="ms-5">
                @csrf
                <button class="danger-button">Atsijungti</button>
            </form>
        </div>
    </div>
</div>

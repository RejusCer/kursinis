@props(['task' => $task])

@php
    // later add field to state table to optimize this code
    $stateColorClass = '';

    if($task->current_state->state_name == "Nepradėta"){
        $stateColorClass = 'notstarted';
    }
    else if($task->current_state->state_name == "Baigta"){
        $stateColorClass = 'completed';
    }
    else if($task->current_state->state_name == "Testuojama"){
        $stateColorClass = 'testing';
    }
    else if($task->current_state->state_name == "Daroma"){
        $stateColorClass = 'inprogress';
    }
@endphp

{{-- task-card --}}
<a href="{{ route('task_inner', [$task->project, $task]) }}" class="secondary-container w-full mb-4 relative flex justify-between border-primary border-x-8 hover:border-tertiary main-transition">
    <div class="border-{{ $stateColorClass }} border-4 border-t-0 absolute top-0 left-[50%] translate-x-[-50%] px-4 py-1 rounded-b-3xl">
        {{ $task->current_state->state_name }}
    </div>

    {{-- checks if task belongs to currently logged in user --}}
    @if (Auth::user()->tasks()->where('task_id', $task->id)->exists())
        <div class="border-4 border-b-0  border-tertiary bg-tertiary absolute bottom-0 left-[50%] translate-x-[-50%] px-4 rounded-t-3xl text-white font-bold text-[16px]">
            PRISKIRTA MAN
        </div>
    @endif

    <div class="flex flex-col justify-between">
        <div class="text-[26px] font-bold">{{ $task->name }}</div>

        @if (count($task->children) != 0)
        <x-reusables.progressionBar :task="$task" />
        @endif
    </div>

    <div class="flex flex-col items-end">
        <div class="mb-[12px] border-2 rounded-xl border-green-600 px-2">0 / {{ $task->time_estimation }}</div>

        <div class="text-end mb-[12px]"><span class="small-gray-font">Terminas:</span> {{ $task->dead_line }}</div>

        @if (count($task->children) != 0)
        <div class="text-end"><span class="small-gray-font">Papildomos užduotys:</span> {{ $task->countChildrenRecursive() - 1 }}</div>
        @endif
    </div>
</a>

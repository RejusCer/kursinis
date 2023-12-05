@props(['project' => $project])

@php
    $tasks = $project->tasks;

    $notStartedCount = $tasks->where('state', 1)->count();
    $completedCount = $tasks->where('state', 2)->count();
    $testingCount = $tasks->where('state', 3)->count();
    $inProgresCount = $tasks->where('state', 4)->count();
@endphp

<div>
    <div class="flex justify-between my-[12px]">
        {{-- Completed --}}
        <div class="border-completed text-black project-status-bubbles">{{ $completedCount }}</div>
        {{-- Not started --}}
        <div class="border-notstarted text-black project-status-bubbles">{{ $notStartedCount }}</div>
    </div>
    <div class="flex justify-between my-[12px]">
        {{-- Inprogress --}}
        <div class="border-inprogress text-black project-status-bubbles">{{ $inProgresCount }}</div>
        {{-- Testing --}}
        <div class="border-testing text-black project-status-bubbles">{{ $testingCount }}</div>
    </div>
</div>

@props(['project' => $project])

@php
    $completedPercent = 0;
    if (count($project->tasks) != 0 ){
        $completedPercent = round($project->countCompletedTasks() / count($project->tasks) * 100);
    }
@endphp

{{-- project card --}}
<a href="{{ route('project_inner', $project) }}" class="border-tertiary border-4 hover:border-primary main-transition bg-tertiary text-black px-3 py-2 rounded-lg w-[24%] max-[1024px]:w-[32%] max-[768px]:w-[49%] me-[1%] mb-[24px] flex flex-col justify-between">
    <div class="text-[18px] font-bold text-center mb-[24px]">{{ $project->name }}</div>
    <div>
        <div class="flex justify-center">
            <div class="bg-white project-status-bubbles w-fit px-1">{{ Auth::user()->getTaskCount($project->id) }} / {{ count($project->tasks) }}</div>
        </div>

        <x-reusables.taskBubbles :project="$project" />

        {{-- <x-reusables.progressionBar /> --}}
        <div class="after:w-[{{ $completedPercent }}%] mt-[12px] project-completion-bar min-w-[100px] max-w-[220px]">
            <span class="bg-primary rounded-3xl px-2 z-20 relative text-white">{{ $completedPercent }}%</span>
        </div>
    </div>
</a>

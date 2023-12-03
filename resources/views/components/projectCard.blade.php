@props(['project' => $project])

{{-- project card --}}
<a href="{{ route('project_inner', $project) }}" class="border-tertiary border-4 hover:border-primary main-transition bg-tertiary text-black px-3 py-2 rounded-lg w-[24%] max-[1024px]:w-[32%] max-[768px]:w-[49%] me-[1%] mb-[24px] flex flex-col justify-between">
    <div class="text-[18px] font-bold text-center mb-[24px]">{{ $project->name }}</div>

    <div>
        <div class="flex justify-center">
            <div class="bg-white project-status-bubbles w-fit px-1">149/7</div>
        </div>

        <x-reusables.taskBubbles />

        <x-reusables.progressionBar />
    </div>
</a>

@props(['project' => $project])

{{-- project card --}}
<a href="#" class="border-tertiary border-4 hover:border-primary main-transition bg-tertiary text-black px-3 py-2 rounded-lg w-[24%] max-[1024px]:w-[32%] max-[768px]:w-[49%] me-[1%] mb-[24px] flex flex-col justify-between">
    <div class="text-[18px] font-bold text-center mb-[24px]">{{ $project->name }}</div>

    <div>
        <div class="flex justify-center">
            <div class="bg-white project-status-bubbles w-fit px-1">149/7</div>
        </div>

        <div class="flex justify-between my-[12px]">
            {{-- Completed --}}
            <div class="bg-completed project-status-bubbles">75</div>
            {{-- Not started --}}
            <div class="bg-notstarted project-status-bubbles">48</div>
        </div>
        <div class="flex justify-between my-[12px]">
            {{-- Inprogress --}}
            <div class="bg-inprogress project-status-bubbles">6</div>
            {{-- Testing --}}
            <div class="bg-testing project-status-bubbles">5</div>
        </div>

        <div class="after:w-[50%] mt-[12px] project-completion-bar">
            <span class="z-20 relative">40%</span>
        </div>
    </div>
</a>

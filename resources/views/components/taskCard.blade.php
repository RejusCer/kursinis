{{-- task-card --}}
<a href="#" class="secondary-container w-full mb-4 relative flex justify-between border-primary border-x-8 hover:border-tertiary main-transition">
    <div class="border-4 border-t-0  border-notstarted absolute top-0 left-[50%] px-4 py-1 rounded-b-3xl">
        Nepradėta
    </div>

    <div class="flex flex-col justify-between">
        <div class="text-[26px] font-bold">Task Title</div>

        <x-reusables.progressionBar />
    </div>

    <div class="flex flex-col">
        <div class="text-end mb-[12px]">2:48 / 8:30</div>

        <div class="text-end mb-[12px]">2023-12-15</div>

        <div class="text-end">Papildomos užduotys: 8</div>
    </div>
</a>

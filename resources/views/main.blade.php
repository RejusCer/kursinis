@extends('layout')

@section('content')


<section class="max-w-screen-lg mx-auto text-white">
    {{-- top-user-info-band --}}
    <div class="main-container flex justify-between">
        <div class="bg-primary rounded-lg px-3 py-2 w-fit">
            <div>
                <span>Projektai:</span>
                <span class="font-bold">4</span>
            </div>
            <div>
                <span>Užduotys:</span>
                <span class="font-bold">45</span>
            </div>
        </div>

        <div class="bg-primary rounded-lg px-3 py-2 w-fit">
            <div>
                {{Auth::user()->name}}
            </div>
            <div class="flex mt-[24px]">
                <form action="">
                    @csrf
                    <button class="primary-btn main-transition">Redaguoti profilį</button>
                </form>

                <form action="{{ route('logout') }}" method="POST" class="ms-5">
                    @csrf
                    <button class="primary-btn bg-red-600 border-red-600 hover:text-red-800 hover:bg-white main-transition hover:border-red-600">Atsijungti</button>
                </form>
            </div>
        </div>
    </div>

    {{-- create new project button and project autput --}}
    <div class="main-container mt-6">
        <a href="{{ route('create') }}" class="mb-[36px] block">
            <button class="primary-btn main-transition">Sukurti naują projektą</button>
        </a>

        @if (session('status'))
            <span class="text-red-400">{{ session('status') }}</span>
        @endif

        <div class="flex justify-start flex-wrap">

            {{-- project card --}}
            <a href="#" class="border-tertiary border-4 hover:border-primary main-transition bg-tertiary text-black px-3 py-2 rounded-lg w-[24%] max-[1024px]:w-[32%] max-[768px]:w-[49%] me-[1%] mb-[24px] flex flex-col justify-between">
                <div class="text-[18px] font-bold text-center mb-[24px]">Projekto pavadinimas</div>

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

        </div>
    </div>
</section>


@extends('layout')

@section('content')

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">

        <div>
            <form action="{{ route('create') }}" method="POST">
                @csrf

                @if (session('status'))
                    <span class="text-red-400">{{ session('status') }}</span>
                @endif

                <div class="my-3">
                    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="text" name="name" placeholder="Projekto pavadinimas">
                    @error('name')
                        <span  class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <button class="primary-btn main-transition">Sukurti projektą</button>
            </form>
        </div>

    </div>
</section>

@endsection

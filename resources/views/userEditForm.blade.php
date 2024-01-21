@extends('layout')

@section('content')

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">

        <div>
            <form action="{{ route('user.edit.form', Auth::user()) }}" method="POST">
                @csrf

                <div class="my-3">
                    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="text" name="name" placeholder="Vardas" value="{{ Auth::user()->name }}">
                    @error('name')
                        <span  class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="my-3">
                    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="email" name="email" placeholder="El. paštas" value="{{ Auth::user()->email }}">
                    @error('email')
                        <span  class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="my-3">
                    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="password" name="password" placeholder="Slaptažodis">
                    @error('password')
                        <span  class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="my-3">
                    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="password" name="password_confirmation" placeholder="Pakartoti slaptažodį">
                </div>

                <button class="primary-btn main-transition">Keisti informaciją</button>
            </form>
        </div>

    </div>
</section>

@endsection










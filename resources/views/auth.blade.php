@extends('layout')

@section('content')

<div class="bg-primary h-screen w-screen flex justify-center items-center">
    <div class="min-w-[50%]">
        <div class="flex w-full">
            <button id="sign-in" class="auth-form-switchers me-2 main-transition">SIGN IN</button>
            <button id="register" class="auth-form-switchers ms-2 main-transition">REGISTER</button>
        </div>

        <div class="bg-secondary p-6 border-t-2 border-primary">
            <div data-form-type="signin">
                <form action="{{ route('signin') }}" method="POST">
                    @csrf

                    @if (session('status'))
                        <span class="text-red-400">{{ session('status') }}</span>
                    @endif

                    <div class="my-3">
                        <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="email" name="email" placeholder="El. paštas">
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

                    <button class="primary-btn main-transition">Prisijungti</button>
                </form>
            </div>
            <div data-form-type="register" class="hidden">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @if (session('status'))
                        <span class="text-red-400">{{ session('status') }}</span>
                    @endif

                    <div class="my-3">
                        <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="text" name="name" placeholder="Vardas">
                        @error('name')
                            <span  class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-3">
                        <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="email" name="email" placeholder="El. paštas">
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

                    <button class="primary-btn main-transition">Registruotis</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

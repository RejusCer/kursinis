@extends('layout')

@section('content')

<div class="bg-primary h-screen w-screen flex justify-center items-center">
    <div class="min-w-[50%]">
        <div class="flex w-full">
            <a href="#" class="w-1/2 bg-secondary rounded-t-3xl px-4 py-8 text-center text-white font-semibold me-2">SIGN IN</a>
            <a href="#" class="w-1/2 bg-secondary rounded-t-3xl px-4 py-8 text-center text-white font-semibold ms-2">REGISTER</a>
        </div>

        <div class="bg-secondary ">
            <div form-type="signin">
                sign in form
            </div>
            <div form-type="register">

            </div>
        </div>
    </div>
</div>

@endsection

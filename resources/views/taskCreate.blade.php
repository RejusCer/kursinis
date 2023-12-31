@extends('layout')

@section('content')

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">

        <div>
            <form action="{{ route('create-task', $project) }}" method="POST">
                @csrf

                <x-reusables.createTaskFields />
            </form>
        </div>

    </div>
</section>

@endsection

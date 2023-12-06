@extends('layout')

@section('content')

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">

        <div>
            <form action="{{ route('create-child-task', [$project, $task]) }}" method="POST">
                @csrf

                <x-reusables.createTaskFields />
            </form>
        </div>

    </div>
</section>

@endsection

@extends('layout')

@section('content')

<section class="max-w-screen-lg mx-auto text-white">
    <div class="main-container">
        <x-reusables.breadcrumbs :project="$project" :task="$task" />

        <div class="flex justify-between mb-[12px]">
            <div>
                <div><span class="small-gray-font">Praleista laiko:</span> {{ $totalString }}</div>
                <div><span class="small-gray-font">Duotas laikas užduočiai:</span> {{ $task->time_estimation }}</div>
            </div>
            <div>
                <div><span class="small-gray-font">Sukurta:</span> {{ $task->created_at->format('Y-m-d') }}</div>
                <div><span class="small-gray-font">Terminas:</span> {{ $task->dead_line }}</div>
            </div>
        </div>

        <div class="secondary-container w-full">
            {!! $task->description !!}
        </div>

        <div class="mt-[12px] flex">
            @if ($userRole == 'admin' && 0 != count($notAsignedUsers = $project->users_not_in_task($task->id)))
            <div class="max-w-[200px] me-[12px]">
                <form action="{{ route('task.add_users', $task) }}" method="POST" class="text-black flex flex-col">
                    @csrf
                    <select name="users[]" id="users" multiple class="bg-secondary text-white border-primary border-2 rounded-md">
                        @foreach ($notAsignedUsers as $user)
                            <option class="px-2" value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <button class="primary-btn main-transition mt-[12px]">Pridėti vartotojus</button>
                </form>
            </div>
            @endif

            <div class="">
                <div class="ms-1 font-bold">Pridėti vartotojai:</div>
                @foreach ($task->users as $user)
                    <span class="user-block">{{ $user->name }}</span>
                @endforeach
            </div>
        </div>

        {{-- track time --}}
        <div class="flex justify-between mt-[24px]  border-2 border-primary rounded-lg p-2">
            <div class="flex flex-row">
                @if (Auth::user()->belongsToTask($task->id) != null)
                <form id="state-form" action="{{ route('task.update.state', $task) }}" method="POST" class="text-black flex flex-col">
                    @csrf
                    <select name="state" id="state-select" class="bg-secondary text-white border-primary border-2 rounded-md">
                        @foreach ($states as $state)
                            @php
                                $selected = $task->current_state->id == $state->id ? "selected" : "";
                            @endphp
                            <option class="px-2" value="{{ $state->id }}" {{ $selected }} >{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </form>
                @endif

                @php
                    $activatedOn = $task->users()->wherePivot('user_id', Auth::user()->id)->value('activatedOn');
                @endphp
                @if ($activatedOn)
                <form action="{{ route('task.stop_time', $task) }}" method="POST" class="ms-4">
                    @csrf
                    <button class="danger-button main-transition">Sustabdyti laiko sekimą</button>
                </form>
                @else
                <form action="{{ route('task.track_time', $task) }}" method="POST" class="ms-4">
                    @csrf
                    <button class="primary-btn main-transition">Sekti laiką</button>
                </form>
                @endif
            </div>

            @if ($userRole == 'admin')
            <form action="{{ route('destroy-task', [$project, $task]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="danger-button">Ištrinti užduotį</button>
            </form>
            @endif
        </div>

        {{-- comments --}}
        <div class="mt-[24px]">
            {{-- post comment form --}}
            <div>
                <button class="primary-btn main-transition" id="show-comment-form">Pridėti komentarą</button>

                <form action="{{ route('comment.store', [Auth::user(), $task]) }}" method="POST" class="hidden" id="comment-post-form">
                    @csrf

                    <div class="my-3 text-black">
                        <textarea class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" name="content" id="editor" cols="30" rows="10" placeholder="Užduoties aprašymas"></textarea>
                        @error('content')
                            <span  class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button class="primary-btn main-transition">Išsaugoti komentarą</button>
                    </div>
                </form>
            </div>

            {{-- get all comments list --}}
            <div>
                @foreach ($comments as $comment)
                    @php
                        $addClasses = '';
                        if ($comment->doesBelongTo(Auth::user()->id)) $addClasses = 'border-2 border-completed';
                    @endphp
                    <div class="mt-[12px] secondary-container w-full {{ $addClasses }}">
                        <div class="flex relative">
                            <div class="small-gray-font">
                                <span>Autorius: {{ $comment->user->name }}</span>
                                <span class="mx-[12px]">|</span>
                                <span>Sukurta: {{ $comment->created_at->format('Y-m-d') }}</span>
                            </div>

                            @if ($comment->doesBelongTo(Auth::user()->id))
                            <div class="absolute top-0 right-0">
                                <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="danger-button">Ištrinti</button>
                                </form>
                            </div>
                            @endif
                        </div>

                        <div>
                            {!! $comment->content !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="main-container">

        @if ($task->is_user_assigned(Auth::user()->id))
            <a href="{{ route('create-child-task', [$project, $task]) }}" class="mb-[36px] block">
                <button class="primary-btn main-transition">Sukurti naują užduotį</button>
            </a>
        @endif

        <div>
            @foreach ($task->children as $task)
                <x-taskCard :task="$task" />
            @endforeach
        </div>
    </div>
</section>

@endsection


@section('scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection

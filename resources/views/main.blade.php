@extends('layout')

@section('content')

Main page

@auth

Tu esi prisijunges

{{Auth::user()->name}}

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button> Atsijungti</button>
</form>
@endsection

@endauth

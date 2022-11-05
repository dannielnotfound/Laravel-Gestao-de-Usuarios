@extends('layouts.app')
@section('title', 'Novo comentário para o usuário {{$user->name}}')
@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">
    Novo comentário para o usuário {{$user->name}}
    {{-- <a href="{{ route('users.create') }}" class="bg-blue-900 rounded-full text-white px-4 text-sm">+</a> --}}
</h1>

{{-- @include('user.includes.validation-form') --}}

<form action="{{ route('comments.store', $user->id) }}" method="POST">
    @include('users.comments._partials.form')
</form>
@endsection
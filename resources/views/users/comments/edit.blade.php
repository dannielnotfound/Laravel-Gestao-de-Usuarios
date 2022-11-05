@extends('layouts.app')
@section('title', 'Editar comentario do usuário {{$user->name}}')

@section('content')
    {{-- @dd($comments) --}}
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar comentário do usuário {{$user->name}}</h1>

@include('includes.validation-form')
<form action="{{ route('comments.update', $comment->id)}}" method="POST">
    @method('PUT')
    @include('users.comments._partials.form')
</form>
@endsection
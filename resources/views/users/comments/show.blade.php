@extends('layouts.app')
@section('title', 'Detalhes do usuário {{$user->name}}')
@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Detalhes do comentário de {{ $user->name }}</h1>
        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->created_at }}</li>
        </ul>
    <form class="py-12" action="{{ route('comments.delete', ['user' => $user->id, 'id' => $commentId]) }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4" value="Deletar">
    </form>
@endsection
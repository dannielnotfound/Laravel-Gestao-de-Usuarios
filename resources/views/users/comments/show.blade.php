@extends('layouts.app')
@section('title', 'Detalhes do usuário {{$user->name}}')
@section('content')
<h1>Detalhes</h1>
@dd($user->name)
<p>{{$commentId}}</p>
@endsection
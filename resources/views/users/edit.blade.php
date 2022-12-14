@extends('layouts.app')
@section('title', 'Editar usuário')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar o usuário {{ $user->name }}</h1>

@include('includes.validation-form')

<form action="{{ route('users.update', $user->id) }}" method="POST"  enctype="multipart/form-data">
    @method('PUT')
    @include('users._partials.form')
</form>
@endsection
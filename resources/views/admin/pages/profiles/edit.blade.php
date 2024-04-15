@extends('adminlte::page')

@section('title', "Editar o Perfil { $profile->name }")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.edit', $profile->id) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar o Perfil {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
                @method('PUT')
                
                @include('admin.pages.profiles._partials.form')
                
            </form>
        </div>
    </div>
@stop
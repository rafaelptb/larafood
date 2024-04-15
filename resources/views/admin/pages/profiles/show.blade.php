@extends('adminlte::page')

@section('title', "Detalhes do Perfil { $profile->name }")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.show', $profile->id) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Detalhes do Perfil <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $profile->name }}</li>
                <li><strong>Descrição:</strong>{{ $profile->description }}</li>
            </ul>
            
            <form action="{{ route('profiles.destroy', $profile->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O PERFIL {{ $profile->name }}</button>
            </form>
            
        </div>
    </div>
@stop
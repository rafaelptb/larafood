@extends('adminlte::page')

@section('title', "Detalhes da Permissão { $permission->name }")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.show', $permission->id) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Detalhes da Permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $permission->name }}</li>
                <li><strong>Descrição:</strong>{{ $permission->description }}</li>
            </ul>
            
            <form action="{{ route('permissions.destroy', $permission->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR A PERMISSÃO {{ $permission->name }}</button>
            </form>
            
        </div>
    </div>
@stop
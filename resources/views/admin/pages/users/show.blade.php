@extends('adminlte::page')

@section('title', "Detalhes do Usuário { $user->name }")

@section('content_header')
<h1>Detalhes do Usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $user->name }}</li>
                <li><strong>E-mail:</strong>{{ $user->email }}</li>
                <li><strong>Empresa:</strong>{{ $user->tenant->name }}</li>
            </ul>
            
            <form action="{{ route('users.destroy', $user->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O USUÁRIO {{ $user->name }}</button>
            </form>
            
        </div>
    </div>
@stop
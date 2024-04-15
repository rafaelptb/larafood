@extends('adminlte::page')

@section('title', "Editar a Permissão { $permission->name }")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.edit', $permission->id) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar a Permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')
                
                @include('admin.pages.permissions._partials.form')
                
            </form>
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', "Detalhes do Plano { $plan->name }")

@section('content_header')
<h1>Detalhes do Plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $plan->name }}</li>
                <li><strong>URL:</strong>{{ $plan->url }}</li>
                <li><strong>Preço:</strong>R$ {{ number_format($plan->price, 2, ',', '.') }}</li>
                <li><strong>Descrição:</strong>{{ $plan->description }}</li>
            </ul>
            
            <form action="{{ route('plans.destroy', $plan->url) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O PLANO {{ $plan->name }}</button>
            </form>
            
        </div>
    </div>
@stop
@extends('site.layouts.basico')

@section('titulo', 'Home')
@section('conteudo')

    <main>
        <a href="{{ route('app.sair') }}">Sair</a>
    </main>

@endsection
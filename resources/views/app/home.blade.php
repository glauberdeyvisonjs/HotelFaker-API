@extends('site.layouts.basico')

@section('titulo', 'Home')
@section('conteudo')

    <main>
        <form action={{ route('app.delete') }}>
            <div>
                <a href="{{ route('app.sair') }}" id="btn-logout">Logout</a>
            </div>

            <div>
                <a href="{{ route('app.delete') }}" id="btn-delete">Excluir conta</a>
            </div>
        </form>
    </main>

@endsection
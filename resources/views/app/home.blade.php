@extends('site.layouts.basico')

@section('titulo', 'Home')
@section('conteudo')

    <main>
        <form action={{ route('app.delete') }}>
            <div>
                <a href="{{ route('app.sair') }}" id="btn-logout">Logout</a>
            </div>

            <div>
    
                <button id="btn-delete" type="submit">Excluir conta</a>

            </div>
        </form>
    </main>

@endsection
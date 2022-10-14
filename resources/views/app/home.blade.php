@extends('site.layouts.basico')

@section('titulo', 'Home')
@section('conteudo')

    <main>
        <form action={{ route('app.delete') }} method="POST">
            @csrf
            <div>
                <a href="{{ route('app.sair') }}" id="btn-logout">Logout</a>
            </div>

            <div>
                <button type="submit" id="btn-delete"
                    style="position: fixed;
                right: 11ch;
                bottom: 93.3%;
                cursor: pointer;
                transition: 0.3s ease-in-out;">Delete</button>
            </div>
        </form>
    </main>

@endsection

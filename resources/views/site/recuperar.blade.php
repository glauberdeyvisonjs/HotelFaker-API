@extends('site.layouts.basico')

@section('titulo', 'Login')
@section('conteudo')

    <main>
        <form action={{ route('recuperar') }} method="post">
            @csrf

            <section class="input-container">
                <span>Insira seu e-mail para recuperar o acesso:</span><br />
                <input name="email" type="email" placeholder="seuemail@exemplo.com" />
            </section>

            @if ($errors->has('email'))
                <div id="erros">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <button id="btn-recuperar">Recuperar senha</button>

            <div>
                {{ isset($feedback) && $feedback != '' ? $feedback : '' }}
            </div>

            <footer>
                <span><a href="/">Voltar para o Login</a></span>
            </footer>
        </form>
    </main>
@endsection

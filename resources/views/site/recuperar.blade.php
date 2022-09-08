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

            <div style="margin-top: 5px;">
                {{ isset($feedback) && $feedback != '' ? $feedback : '' }}
            </div>

            <button id="btn-recuperar">Recuperar senha</button>

            <footer>
                <span><a href="/">Voltar para o Login</a></span>
            </footer>
        </form>
    </main>
@endsection

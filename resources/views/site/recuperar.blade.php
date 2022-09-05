@extends('site.layouts.basico')

@section('titulo', 'Login')
@section('conteudo')

    <main>
        <form>
            <section class="input-container">
                <span>Insira seu e-mail para recuperar o acesso:</span><br />
                <input type="email" placeholder="seuemail@exemplo.com" />
            </section>

            <button id="btn-recuperar">Recuperar senha</button>

            <footer>
                <span><a href="/">Voltar para o Login</a></span>
            </footer>
        </form>
    </main>
@endsection

@extends('site.layouts.basico')

@section('titulo', 'Login')
@section('conteudo')

    <main>
        <form action={{ route('site.principal') }} method="post">
            @csrf
            <section class="input-container">
                <input name="email" value="{{ old('email') }}" type="email" placeholder="seuemail@exemplo.com" />

                @if ($errors->has('email'))
                    <div id="erros">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <div class="password-container">
                    <input name="senha" type="password" id="field-password" placeholder="********" />

                    @if ($errors->has('senha'))
                    <div id="erros">
                        {{ $errors->first('senha') }}
                    </div>
                    @endif
                    
                    <div style="color: red;">
                        {{ isset($feedback) && $feedback != '' ? $feedback : '' }}
                    </div>

                </div>
            </section>

            <section class="password-infos">
                <div>
                    <input type="checkbox" />
                    <span>Lembrar Senha</span>
                </div>
                <a href="{{ asset('/recuperar-senha') }}">Esqueceu sua senha?</a>
            </section>

            <button id="btn-login" type="submit">Login</button>

            <footer>
                <hr />
                <span>Ainda não tem uma conta?
                    <a href="{{ asset('/cadastro') }}">Cadastre-se!</a></span>
            </footer>
        </form>
    </main>

@endsection
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
                    
                    <input name="password" type="password" id="field-password" placeholder="********" />

                    @if ($errors->has('password'))
                        <div id="erros">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    @include('site.layouts._partials.flash-message')

                </div>
            </section>

            <section class="password-infos">
                <div>
                    <input type="checkbox" />
                    <span>Lembrar password</span>
                </div>
                <a href="{{ asset('/recuperar-password') }}">Esqueceu sua password?</a>
            </section>

            <button type="submit" class="btn-submit">Login</button>

            <footer>
                <hr />
                <span>Ainda não tem uma conta?
                    <a href="{{ asset('/cadastro') }}">Cadastre-se!</a></span>
            </footer>
        </form>
    </main>

@endsection

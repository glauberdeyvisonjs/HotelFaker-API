@extends('site.layouts.basico')

@section('titulo', 'Cadastro')
@section('conteudo')

    <main>
        <form class="cadastro" action={{ route('cadastrar') }} method="post">
        @csrf
            <section class="input-container">
                <div class="input-container">
                
                    <span>Insira seu nome:</span>
                    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Ex: João da Silva" />
                </div>

                @if ($errors->has('nome'))
                    <div style="font-size: 11px; color: red; margin-bot: 0px;">
                        {{ $errors->first('nome') }}
                    </div>
                @endif

                <div class="input-container">
                    <span>Insira seu e-mail:</span>
                    <input name="email" value="{{ old('email') }}" type="email" placeholder="seuemail@exemplo.com" />
                </div>

                @if ($errors->has('email'))
                    <div style="font-size: 11px; color: red; margin-bot: 0px;">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <div class="password-container">
                    <span>Insira sua senha:</span>

                    <input name = "senha" type="password" id="field-password" placeholder="********" />

                    @if ($errors->has('senha'))
                    <div style="font-size: 11px; color: red; margin-bot: 0px;">
                        {{ $errors->first('senha') }}
                    </div>
                    @endif

                </div>
                <div class="password-container">
                    <span>Confirme sua senha:</span>
                    <input name = "confirm_senha" type="password" id="field-password" placeholder="********" />
                    @if ($errors->has('confirm_senha'))
                    <div style="font-size: 11px; color: red; margin-bot: 0px;">
                        {{ $errors->first('confirm_senha') }}
                    </div>
                    @endif
                    
                </div>
            </section>

            <div id="">
                {{ isset($feedback) && $feedback != '' ? $feedback : '' }}
            </div>

            <button id="btn-cadastro" type='submit'>Cadastre-se</button>

            <footer>
                <hr />
                <span>Já possui uma conta?
                    <a href="/">Faça Login!</a></span>
            </footer>
        </form>
    </main>
@endsection
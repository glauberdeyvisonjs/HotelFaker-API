<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Helper - Cadastro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/cadastro.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>

</head>

<body>
    <header>
        <h1>Login Helper - Cadastro</h1>
    </header>

    <main>
        <form action={{ route('cadastrar') }} method="post">
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
                <div class="password-container-c">
                    <span>Confirme sua senha:</span>
                    <input nome = "confirm_senha" type="password" id="field-password-c" placeholder="********" />
                    @if ($errors->has('confirm_senha'))
                    <div style="font-size: 11px; color: red; margin-bot: 0px;">
                        {{ $errors->first('confirm_senha') }}
                    </div>
                    @endif
                </div>
            </section>

            <button id="btn-cadastro" type='submit'>Cadastre-se</button>

            <footer>
                <hr />
                <span>Já possui uma conta?
                    <a href="/">Faça Login!</a></span>
            </footer>
        </form>
    </main>
</body>

</html>

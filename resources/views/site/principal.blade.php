<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Helper</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>

</head>

<body>
    <header>
        <h1>Login Helper</h1>
    </header>

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

                    {{ isset($erro) && $erro != '' ? $erro : '' }}

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
</body>

</html>

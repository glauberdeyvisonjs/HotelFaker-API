<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Helper - Recuperar Senha</title>
    <link rel="stylesheet" href="{{ asset('/css/recuperar.css') }}" />
    <script src="{{ asset('/js/app.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Login Helper - Recuperar Senha</h1>
    </header>

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
</body>

</html>

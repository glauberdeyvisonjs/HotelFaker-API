<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>

    <style type="text/css">
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #00FFB5;
            /* Local font */
            font-family: Clash Display Variable;
            font-weight: 700;
            color: #fff;
        }

        /* Demo */
        .showcase {
            display: grid;
            height: 100vh;
            gap: 10px;
        }

        /* Selects every direct child and applies general styles for the demo */
        .showcase>* {
            display: grid;
            place-items: center;
            padding: 10px;
        }

        @media screen and (min-width: 64em) {
            .showcase {
                grid-template-columns: 150px 1fr;
                grid-template-rows: 50px repeat(2, 1fr) 50px;
                grid-template-areas:
                    "header header"
                    "sidebar main"
                    "sidebar main"
                    "sidebar footer";
            }

            .header {
                grid-area: header;
                background-color: #162C27;
            }

            .sidebar {
                grid-area: sidebar;
                backgroung-image: url('https://img.freepik.com/premium-photo/manhattan-modern-architecture_173948-2324.jpg?w=1380');
            }

            .main {
                grid-area: main;
                background-image: url('https://img.freepik.com/free-photo/close-up-gray-blanket-bed_1122-1470.jpg?1&w=1380&t=st=1665752029~exp=1665752629~hmac=81171bbba1e09ad1c2d6870f81eb1adeea03bfe5ed9282b5491cde687e6e1662');
            }

            .footer {
                grid-area: footer;
            }
        }
    </style>
</head>

<body>

    <section class="showcase">
        <header class="header">
            <h2 class="text-header">Olá!</h2>
            <h2 class="text-header">Você fez o cadastro no Fake Hostel?</h2>
        </header>
        <aside class="sidebar">

        </aside>
        <div class="main">
            <h5 class="text-main">Por favor, clique
                aqui para confirmar seu cadastro!</h5>

            <p class="text-main">Caso não tenha feito nenhum cadastro, ignore esse email.</p>

            <p class="text-att">Atenciosamente, <br>
                Fake Hostel.
            </p>
        </div>
        <footer class="footer">
            <strong>Copyright &copy; 2021-2022 | Fake Hostel | </strong>
            Todos os direitos reservados.
        </footer>
    </section>

</body>

</html>

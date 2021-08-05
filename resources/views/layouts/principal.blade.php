<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de estoque</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/produtos">
                        Estoque Laravel
                    </a>
                </div>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('ProdutoController@lista')}}">
                            Listagem
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('ProdutoController@novo')}}">
                            Novo
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('conteudo')

        <footer class="footer">
            <p>&copy; Livro de Laravel da Caso do Código.</p>
        </footer>

    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

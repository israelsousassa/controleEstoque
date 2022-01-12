<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/img/icone-g.png" type="image/png">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GreenSystem</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <div class="logo"><b class="text-success">Green</b><b class="text-secondary">System</b></div>
    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <div class="icon">
                                <ion-icon src = "/icones/add-circle-sharp.svg"></ion-icon>
                            </div>
                        
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@listaEntrada') }}" class="nav-link" >Entrada</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/remove-circle-sharp.svg"></ion-icon>
                            </div>
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@listaSaida') }}" class="nav-link" >Saída</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/cube-sharp.svg"></ion-icon>
                            </div>
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@registra') }}" class="nav-link" >Cadastrar</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/person-sharp.svg"></ion-icon>
                            </div>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            
                            
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            </li>
                            

                                
                            @endif
                        @else
                            <div class="icon">
                                <ion-icon src = "/icones/list-circle-sharp.svg"></ion-icon>
                               
                            </div>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                Listas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ action('ProdutoController@lista') }}">Produtos</a>
                                <a class="dropdown-item" href="{{ action('EntradaController@listaInput') }}">Entrada produto</a>
                                <a class="dropdown-item" href="{{ action('SaidaController@listaOut') }}">Saída produto</a>
                                </div>
                            </li>

                            <div class="icon">
                                <ion-icon src = "/icones/add-circle-sharp.svg"></ion-icon>
                            </div>
                        
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@listaEntrada') }}" class="nav-link">Entrada</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/remove-circle-sharp.svg"></ion-icon>
                            </div>
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@listaSaida') }}" class="nav-link">Saída</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/list-circle-sharp.svg"></ion-icon>
                               
                            </div>
                            <li class="nav-item">
                                <a href="{{ action('FornecedorController@fornecedor') }}" class="nav-link">Fornecedor</a>
                            </li>
                            <div class="icon">
                                <ion-icon src = "/icones/cube-sharp.svg"></ion-icon>
                            </div>
                            <li class="nav-item">
                                <a href="{{ action('ProdutoController@registra') }}" class="nav-link" >Cadastrar</a>
                            </li>

                            <div class="space"></div>

                            <div class="user">
                                <ion-icon size="large" src = "/icones/person-circle-outline.svg"></ion-icon>
                    
                            </div>

                        <li class="nav-item dropdown">
                            
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <div class="container">
            <footer class="footer text-center">
                
                <span class="text-muted logo">&copy;<?= date('Y'); ?> GreenSystem</span>
                
            </footer>
        </div>
    </div>

   
    
     
     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

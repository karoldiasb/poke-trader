<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poke - Trader </title>

    {{-- Styles --}}
    @livewireStyles
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


</head>

<body>

    <header class="p-3 bg-secondary text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <h3 class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    Poke Trader
                </h3>
            </div>
        </div>
    </header>

    <div class="container" style="margin-top: 20px">
        <div class="card">
            <div class="card-body">
                Poke Trader é uma calculadora de trades de pokemon que possui como finalidade calcular se
                uma troca é "justa" ou não. <br>
                É necessário selecionar de 1 a 6 pokemons de cada lado e clicar no botão "Calcular". <br>
                Se a troca for justa, ou seja, a diferença entre Jogador 1 e Jogador 2 for menor que "20",
                é possível realizar a troca.
            </div>
        </div>
    </div>

    @yield('container')

    {{-- Scripts --}}
    @livewireScripts
    <script src="/js/app.js"></script>


</body>

</html>

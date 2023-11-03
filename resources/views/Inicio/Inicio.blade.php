<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Início - Código do Dia</title>
    <link rel="stylesheet" href="{{asset('css/inicio.css')}}?{{getenv('APP_VERSION')}}">
</head>
<body>

    <main>
        <h1>Código do Dia</h1>

        <div id="cartoes">
            <div class="cartao">
                <h2>Dicas e Tutoriais</h2>
                <p>Obtenha funções, métodos e códigos que vão simplificar a sua vida na programação.</p>
                <a href="#">Ver</a>
            </div>
            <div class="cartao">
                <h2>Design</h2>
                <p>Parte dedicada ao design dos sistemas, tenha ideias, inovações e referências para o layout do seu projeto.</p>
                <a href="#">Ver</a>
            </div>
            <div class="cartao">
                <h2>Criadores</h2>
                <p>Se você é criador de conteúdo ou quer começar, seja no youtube ou em qualquer outra plataforma, esse é o lugar certo.</p>
                <a href="#">Ver</a>
            </div>
        </div>
    </main>

    <footer>

    </footer>
    <script src="{{asset('js/jquery.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script src="{{asset('js/inicio.js')}}?{{getenv('APP_VERSION')}}"></script>
</body>
</html>
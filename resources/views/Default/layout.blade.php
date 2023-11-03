<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo}}</title>
    <link rel="shortcut icon" href="{{asset('image/logo-icon.png')}}?{{getenv('APP_VERSION')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/cabecalho.css')}}?{{getenv('APP_VERSION')}}">
    <link rel="stylesheet" href="{{asset('css/rodape.css')}}?{{getenv('APP_VERSION')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}?{{getenv('APP_VERSION')}}">
    <link rel="stylesheet" href="{{asset('css/mobile.css')}}?{{getenv('APP_VERSION')}}">
    @yield('css')
</head>
<body>
    @php
        use Illuminate\Support\Facades\Session;
        $erro = false;
        if (Session::get('erro') != null)
        {
            $erro = Session::get('erro')['codigo'];
            $erro = config("errors.$erro.mensagem") ?? 'Houve um erro interno!';
        }
    @endphp

    @if ($erro != false)
        <div class="notification" id="notErro">
            <div>
                <i class="svgFill">
                    <svg style="width: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
                </i>
            </div>

            <div>
                <span>Erro: {{$erro}}</span>
            </div>
        </div>
    @endif

    <div class="notification alerta">
        <div>
            <i class="svgFill">
                <svg style="width: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
            </i>
        </div>

        <div>
            <span id="alertaConteudo"></span>
        </div>
    </div>

    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <header>
        <span id="codigododia">
            Código do Dia
        </span>

        <div id="espaco-menu"></div>

        <menu>
            <ul>
                <a href="{{route('dicas.principal')}}"><li class="{{ session('prefixo') === '/dicas' ? 'ativo' : '' }}">Dicas e Tutoriais</li></a>
                <!-- <li class="{{ session('prefixo') === '/design' ? 'ativo' : '' }}" onclick="abrirLink('{{route('design.principal')}}', true)">Design</li>-->
                <a href="{{route('criadores.principal')}}"><li class="{{ session('prefixo') === '/criadores' ? 'ativo' : '' }}">Criadores</li></a>
                <li id="tema" onclick="mudarTemaBtn()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>
                </li>
            </ul>
        </menu>

       @if (getenv('APP_LOGIN'))
            @if (Session::get('usuario') != null)
                <img id="perfil" src="{{asset(Session::get('usuario')->foto)}}" onclick="abrirLink('{{route('usuario.perfil')}}', true)" alt="Ícone do perfil como menu" id="perfil-logar">
            @else
                <img id="perfil" src="{{asset('image/usuario1.png')}}" onclick="abrirLink('{{route('usuario.login')}}', true)" alt="Ícone do perfil como menu" id="perfil-logar">            
            @endif
       @endif

    </header>

    <main>
        <section>
            @yield('section')
        </section>
        
        @if (isset($customizar))            
            @yield('aside')
        @else
            <aside>
                <h1>Notícias e Novidades</h1>
            </aside>
        @endif
    </main>

    <footer>
        <div></div>
        <div><span>&copy; CopyRight 2023</span></div>
        <div class="redes-sociais">
            <span>Redes Sociais</span>
            <div>
                <div class="insta" onclick="abrirLink('https://www.instagram.com/marcos.silva.ma', false)">
                    <i class="svgFill">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </i>
                </div>
                
                <div class="linkedin" onclick="abrirLink('https://www.linkedin.com/in/antonio-marcos-a1979518a', false)">
                    <i class="svgFill">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>
                    </i>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('js/jquery.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script src="{{asset('js/cabecalho.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script src="{{asset('js/script.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script src="{{asset('js/getSemId.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script>
        var csrfToken = $('#token').val()
    </script>
    @if ($erro)
        <script>
            $(document).ready(() => {
                $('#notErro').addClass('ativo')
                setTimeout(() => {
                    $('#notErro').removeClass('ativo')                    
                }, 5000);
            })
        </script>
    @endif
    @yield('javascript')
</body>
</html>
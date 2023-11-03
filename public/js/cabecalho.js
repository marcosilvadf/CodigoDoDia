var root = document.documentElement;
var luaSvg = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>'
var solSvg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24"><path d="M 11 0 L 11 3 L 13 3 L 13 0 L 11 0 z M 4.2226562 2.8085938 L 2.8085938 4.2226562 L 4.9296875 6.34375 L 6.34375 4.9296875 L 4.2226562 2.8085938 z M 19.777344 2.8085938 L 17.65625 4.9296875 L 19.070312 6.34375 L 21.191406 4.2226562 L 19.777344 2.8085938 z M 12 5 C 8.1458514 5 5 8.1458514 5 12 C 5 15.854149 8.1458514 19 12 19 C 15.854149 19 19 15.854149 19 12 C 19 8.1458514 15.854149 5 12 5 z M 12 7 C 14.773268 7 17 9.2267316 17 12 C 17 14.773268 14.773268 17 12 17 C 9.2267316 17 7 14.773268 7 12 C 7 9.2267316 9.2267316 7 12 7 z M 0 11 L 0 13 L 3 13 L 3 11 L 0 11 z M 21 11 L 21 13 L 24 13 L 24 11 L 21 11 z M 4.9296875 17.65625 L 2.8085938 19.777344 L 4.2226562 21.191406 L 6.34375 19.070312 L 4.9296875 17.65625 z M 19.070312 17.65625 L 17.65625 19.070312 L 19.777344 21.191406 L 21.191406 19.777344 L 19.070312 17.65625 z M 11 21 L 11 24 L 13 24 L 13 21 L 11 21 z"></path></svg>'
var menuSvg = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>'
var tema = []
var fundo = []
tema['claro'] = [
    ['--h-texto', '#f2f0f0'],
    ['--texto-linha', '#f2f0f0'],
    ['--cor-fundo-selecao', '#00a6e7'],
    ['--cor-fundo-selecao-texto','white'],
    ['--fundo-header','rgba(20, 50, 66, 0.5)'],
    ['--fundo','white'],
    ['--fundo-branco','white'],
    ['--fonte','black'],
    ['--borda-input','black'],
    ['--fundo-header-btn','rgba(20, 50, 66, 0.8)'],
    ['--fundo-menu','rgba(20, 50, 66, 0.8)'],
    ['--fundo-table','rgba(0, 0, 0, .1)']
]

tema['escuro'] = [
    ['--h-texto', '#e0e0e0'],
    ['--texto-linha', '#006480'],
    ['--cor-fundo-selecao', '#255768'],
    ['--cor-fundo-selecao-texto','#e0e0e0'],
    ['--fundo-header','rgba(0, 0, 0, 0.5)'],
    ['--fundo', '#001014'],
    ['--fundo-branco','rgba(0, 0, 0, 0.5)'],
    ['--fonte','#e0e0e0'],
    ['--borda-input','#e0e0e0'],
    ['--fundo-header-btn','rgba(255, 255, 255, 0.1)'],
    ['--fundo-menu','rgba(20, 22, 24, 0.9)'],
    ['--fundo-table','rgba(255, 255, 255, .1)']
]

document.addEventListener('DOMContentLoaded', function() {
    mudarTelaParaMobile(window.innerWidth <= 767)    
    if(cookie('tema', '', 0, 'verificar')){
        tema['atual'] = cookie('tema', '', 0, 'pegar')
        temaFuncao()
    } else {
        cookie('tema', 'claro', 365, 'criar')
        tema['atual'] = cookie('tema', '', 0, 'pegar')
        temaFuncao()
    }
})

function mudarTemaBtn() {
    if (tema['atual'] == 'claro') {
        tema['atual'] = 'escuro'
        cookie('tema', 'escuro', 365, 'criar')
        temaFuncao()
    } else {
        tema['atual'] = 'claro'
        cookie('tema', 'claro', 365, 'criar')
        temaFuncao()
    }
}

function temaFuncao() {
    if (tema['atual'] == 'escuro') {
        tema['escuro'].forEach(element => {
            root.style.setProperty(element[0], element[1])
        })
        $('#tema').attr('onclick', 'mudarTemaBtn()')
        $('#tema').html(solSvg)
        $('#tema > svg').attr('fill', 'white')
        $('.svgFill > svg').attr('fill', '#e0e0e0')
        cookie('tema', 'escuro', 365, 'criar')
    } else {
        tema['claro'].forEach(element => {
            root.style.setProperty(element[0], element[1])
        })        
        $('#tema').attr('onclick', 'mudarTemaBtn()')
        $('#tema').html(luaSvg)
        $('#tema > svg').attr('fill', 'black')
        $('.svgFill > svg').attr('fill', '#f2f0f0')
        cookie('tema', 'claro', 365, 'criar')
    }
    setTimeout(() => {
        $('html').addClass('tema-' + tema['atual'])
    }, 200);
}

function mudarTelaParaMobile(telaBoolean) {
    if (telaBoolean) {
      if (!$('header > .menu').length > 0) {
        $('header > menu > ul').append($('header > img'))
        $('header').append(`<i class="menu svgFill" onclick="menuMobile()">${menuSvg}</i>`)
        if (tema['atual'] == 'escuro') {
            $('.menu > svg').attr('fill', '#e0e0e0')
        } else {
            $('.menu > svg').attr('fill', '#203A43')
        }
      }
    } else {
        $('header').append($('header > menu > ul > img'))
        $('header > .menu').remove();
    }    
}

function menuMobile() {    
    if ($('menu ul').hasClass('ativo')) {
        $('menu ul').removeClass('ativo')
    } else {
        $('menu ul').addClass('ativo')        
    }
}

function cookie(nome, valor, dias, acao) {
    var dataAtual = new Date()
    var dataExpiracao = new Date(dataAtual.getTime() + (dias * 24 * 60 * 60 * 1000))
    switch (acao) {
        case 'criar':            
            document.cookie = `${nome}=${valor}; expires=dataExpiracao; path=/`
            break;

        case 'verificar':
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                if (cookie.indexOf(nome + '=') === 0) {
                return true;
                }
            }
            return false;
            break;

        case 'pegar':
            var valorCookie = document.cookie.replace(new RegExp('(?:(?:^|.*;\\s*)' + nome + '\\s*\\=\\s*([^;]*).*$)|^.*$'), "$1")
            return valorCookie
            break;

        case 'apagar':            
            document.cookie = `${nome}=; expires=${dataExpiracao}; path=/`
            break;
        default:
            break;
    }
}

$(window).on('resize', function() {
    mudarTelaParaMobile($(window).width() <= 767)
})
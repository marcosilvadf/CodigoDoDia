//tipo = true == link interno, tipo = false == link externo
function abrirLink(link, tipo) {
    if (tipo) {
        window.location.href = link
    } else {
        window.open(link, '_blank')        
    }
}

$(document).ready(() => {
    
})

$(window).on('pageshow', function(event) {
    if (event.originalEvent.persisted) {
        $('body').removeClass('ativo')
    }
})

function copiarTexto(texto) {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop
    var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft
    var input = document.createElement('textarea');
    input.value = texto;
    input.setAttribute('readonly', '');
    input.style.position = 'absolute';
    input.style.left = '-9999px';
    
    document.body.appendChild(input);
    
    input.focus();
    input.select();
    
    document.execCommand('selectAll');
    document.execCommand('copy');
    
    document.body.removeChild(input);
    notificacao('Conteúdo copiado!', 3000)
  
    window.scrollTo(scrollLeft, scrollTop)
}

function notificacao(texto, duracao) {
    $('#alertaConteudo').html(texto)
    $('.alerta').addClass('ativo')
    setTimeout(() => {
        $('.alerta').removeClass('ativo')
    }, duracao)
}

function pegarConteudoCopiar(id) {
    let html = htmlCopia[id]
    copiarTexto(html)
}
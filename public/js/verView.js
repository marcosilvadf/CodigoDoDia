var htmlCopia = []

function htmlTexto(novoTexto) {
    novoTexto = novoTexto.replace(/(\w+)="/g, `<span style='color: #9cdcfe'>$1=</span>"`)
    novoTexto = novoTexto.replace(/(\w+)-<span style='color: #9cdcfe'>/g, `<span style='color: #9cdcfe'>$1-`)
    novoTexto = novoTexto.replace(/"(.*?)"/g, `<span style="color: #ce8349">"$1"</span>`)
    novoTexto = novoTexto.replace(/&gt;(.*?)&lt;/g, '&gt;<span style="color: white">$1</span>&lt;')
    return novoTexto
}

function funcoes(novoTexto) {
    novoTexto = novoTexto.replace(/"(.*?)"/g, `<span style="color: #ce8349">"$1"</span>`)
    novoTexto = novoTexto.replace(/'(.*?)'/g, `<span style="color: #ce8349">'$1'</span>`)
    novoTexto = novoTexto.replace(/class (\w+)/g, `<span style='color: #3ac9a2'>class $1</span>`)
    novoTexto = novoTexto.replace(/var (\w+)/g, `<span style='color: #3ac9a2'><span style='color: #2193b0'>var</span> $1</span>`)
    novoTexto = novoTexto.replace(/extends (\w+)/g, `extends <span style='color: #3ac9a2'>$1</span>`)
    novoTexto = novoTexto.replace(/(\w+)::/g, `<span style='color: #3ac9a2'>$1::</span>`)
    novoTexto = novoTexto.replace(/\$(\w+)/g, `<span style='color: #9cdcfe'>$</span><span style='color: #9cdcfe'>$1</span>`)
    novoTexto = novoTexto.replace(/(\w+)\(/g, `<span style='color: #d0dc8b'>$1(</span>`)
    novoTexto = novoTexto.replace(/\/\*\*([\s\S]*?)\*\//g, `<span style='color: #529949'>/**$1*/</span>`)
    novoTexto = novoTexto.replace(/\/\*([\s\S]*?)\*\//g, `<span style='color: #529949'>/*$1*/</span>`)
    novoTexto = novoTexto.replace(/^\s*\/\/.*$/gm, `<span style='color: #0f9b0f'>$&</span>`)
    novoTexto = novoTexto.replaceAll('(', `<span style='color: #da63a0'>(</span>`)
    novoTexto = novoTexto.replaceAll(')', `<span style='color: #da63a0'>)</span>`)
    novoTexto = novoTexto.replaceAll('{', `<span style='color: #da63a0'>{</span>`)
    novoTexto = novoTexto.replaceAll('}', `<span style='color: #da63a0'>}</span>`)
    novoTexto = novoTexto.replaceAll('[', `<span style='color: #da63a0'>[</span>`)
    novoTexto = novoTexto.replaceAll(']', `<span style='color: #da63a0'>]</span>`)
    novoTexto = novoTexto.replaceAll('null', `<span style='color: #0058b0'>null</span>`)
    novoTexto = novoTexto.replaceAll('function', `<span style='color: #0058b0'>function</span>`)
    novoTexto = novoTexto.replaceAll('return', `<span style='color: #da63a0'>return</span>`)
    novoTexto = novoTexto.replaceAll('class', `<span style='color: #2c7ad6'>class</span>`)
    return novoTexto
}

$('.codigoHTML').each(function (index, codigo) {
    let html = $(codigo).html()
    let novoHTMLCopia = $(codigo).html()

    novoHTMLCopia = novoHTMLCopia.replaceAll('&lt;', '<')
    novoHTMLCopia = novoHTMLCopia.replaceAll('&gt;', '>')

    htmlCopia[$(codigo).attr('id')] = novoHTMLCopia

    $(codigo).html(htmlTexto(html))
})

$('.codigoFunc').each(function (index, codigo) {
    let html = $(codigo).html()
    let novoHTMLCopia = $(codigo).html()

    novoHTMLCopia = novoHTMLCopia.replaceAll('&amp;', '&')

    novoHTMLCopia = novoHTMLCopia.replaceAll('&lt;', '<')
    novoHTMLCopia = novoHTMLCopia.replaceAll('&gt;', '>')

    htmlCopia[$(codigo).attr('id')] = novoHTMLCopia

    $(codigo).html(funcoes(html))
})
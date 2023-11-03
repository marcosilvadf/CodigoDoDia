var tema = []
var root = document.documentElement;
var luaSvg = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>'
var solSvg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24"><path d="M 11 0 L 11 3 L 13 3 L 13 0 L 11 0 z M 4.2226562 2.8085938 L 2.8085938 4.2226562 L 4.9296875 6.34375 L 6.34375 4.9296875 L 4.2226562 2.8085938 z M 19.777344 2.8085938 L 17.65625 4.9296875 L 19.070312 6.34375 L 21.191406 4.2226562 L 19.777344 2.8085938 z M 12 5 C 8.1458514 5 5 8.1458514 5 12 C 5 15.854149 8.1458514 19 12 19 C 15.854149 19 19 15.854149 19 12 C 19 8.1458514 15.854149 5 12 5 z M 12 7 C 14.773268 7 17 9.2267316 17 12 C 17 14.773268 14.773268 17 12 17 C 9.2267316 17 7 14.773268 7 12 C 7 9.2267316 9.2267316 7 12 7 z M 0 11 L 0 13 L 3 13 L 3 11 L 0 11 z M 21 11 L 21 13 L 24 13 L 24 11 L 21 11 z M 4.9296875 17.65625 L 2.8085938 19.777344 L 4.2226562 21.191406 L 6.34375 19.070312 L 4.9296875 17.65625 z M 19.070312 17.65625 L 17.65625 19.070312 L 19.777344 21.191406 L 21.191406 19.777344 L 19.070312 17.65625 z M 11 21 L 11 24 L 13 24 L 13 21 L 11 21 z"></path></svg>'

tema['claro'] = [
    ['--fundo', 'white'],
    ['--texto-h1-p', '#203A43'],
    ['--texto-cartao', 'white'],
    ['--card1', '#FF0099'],
    ['--card2', '#f18900'],
    ['--card3', '#009ddb'],
    ['--cor-fundo-selecao', '#3390ff'],    
    ['--cor-fundo-selecao-texto', 'white']
]

tema['escuro'] = [
    ['--fundo', '#041920'],
    ['--texto-h1-p', '#e0e0e0'],
    ['--texto-cartao', '#e0e0e0'],
    ['--card1', 'rgba(255, 0, 153, 0.4)'],
    ['--card2', 'rgba(241, 137, 0, 0.5)'],
    ['--card3', 'rgba(0, 157, 219, 0.5)'],
    ['--cor-fundo-selecao', '#203A43'],
    ['--cor-fundo-selecao-texto', '#e0e0e0']
]



function temaFuncao(event, temaClaro) {
    if (temaClaro) {
        tema['escuro'].forEach(element => {
            root.style.setProperty(element[0], element[1])
        })
        $(event.currentTarget).attr('onclick', 'temaFuncao(event, false)')
        $('#tema').html(solSvg)
        $('#tema > svg').attr('fill', 'white')
    } else {
        tema['claro'].forEach(element => {
            root.style.setProperty(element[0], element[1])
            $(event.currentTarget).attr('onclick', 'temaFuncao(event, true)')
            $('#tema').html(luaSvg)
            $('#tema > svg').attr('fill', 'black')
        })
    }
}
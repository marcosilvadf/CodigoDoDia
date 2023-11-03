function salvarIdSession(linkPost, link, id, acao) {
    let data = {
    _token: csrfToken,
    id: id,
    acao: acao
    }

    $('body').addClass('ativo')
    $.post(linkPost, data, function(response) {
        if (response.res) {
            console.log(response)
            abrirLink(link, true)
        } else {
        }
    })
}
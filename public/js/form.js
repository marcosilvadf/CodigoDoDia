var image = document.querySelector('img.perfil')
var file = document.querySelector('#imagem')
var span = document.querySelector('#nomeImagem')
var caminhoOriginal = $('img.perfil').attr('src')

file.addEventListener('change', function()
{    
    let reader = new FileReader()

    if(file.files.length <= 0)
    {
        file.value = null
        span.innerHTML = 'Selecione uma imagem de perfil'
            if(typeof originalProfile !== 'undefined'){
                image.src = originalProfile
            }else{
                image.src = caminhoOriginal

            }
        return
    }

    reader.onload = function ()
    {        
        image.src = reader.result
        span.innerHTML = file.files[0].name        
    }

    reader.readAsDataURL(file.files[0])
})
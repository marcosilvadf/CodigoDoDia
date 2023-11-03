@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="formulario">
    <h1>Cadastrar</h1>
    @if ($editar)
        <form action="{{route('usuario.edit.post')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
    @else
        <form action="{{route('usuario.novo.post')}}" method="post" enctype="multipart/form-data">
    @endif
        @csrf
        <label for="imagem" id="conteudoImagem">
            <img @if ($editar) src="{{asset($usuario->foto)}}" @else src="{{asset('image/usuario1.png')}}" @endif alt="" class="perfil">
            <span id="nomeImagem">Selecione uma imagem de perfil</span>
        </label>
        <input type="file" name="imagem" id="imagem" accept="image/*">
        <input type="text" name="nome" id="nome" placeholder="Nome:" value="{{$usuario->nome ?? ''}}" minlength="4" maxlength="20" required>
        <input type="email" name="email" id="email" placeholder="E-mail:" @if ($editar) readonly @endif value="{{$usuario->email ?? ''}}" required>        
        
        @if (!$editar)
            <input type="password" name="senha" id="senha" placeholder="Senha:" minlength="4" maxlength="20" required>
            <input type="password" name="" id="confirmsenha" placeholder="Confirme a Senha:"minlength="4" maxlength="20" required>
        @endif

        <input type="submit" id="btnSubmit" value="@if ($editar) salvar @else cadastrar @endif" class="enviar">
    </form>
    @if (!$editar)
        <a class="btn" href="{{route('usuario.login')}}" style="align-self: flex-end">Já tem cadastro?</a>
    @endif
</div>
@endsection

@section('javascript')
    <script src="{{asset('js/form.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script>

        $('#btnSubmit').click(function (e) { 
            if ($('#senha').val() != $('#confirmsenha').val()) {
                e.preventDefault()
                alert('Senhas não coincidem!')
            }
            let reader = new FileReader()

            if(file.files.length <= 0 && !($("#id").length)) {
                e.preventDefault()
                alert('Adicione uma foto de perfil!')                
            }
        })
    </script>
@endsection
@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="formulario">
    <h1>{{$edit ? "Editar" : "Cadastrar"}}</h1>
    @if ($edit)
        <form action="{{route('criadores.edit.post')}}" method="post" enctype="multipart/form-data">
        <a class="btn" onclick="certeza('{{$post->titulo}}', {{$post->id}})" style="align-self: flex-end">Excluir</a>
        <input type="hidden" name="criador_id" value="{{$post->id}}">
    @else
        <form action="{{route('criadores.novo.post')}}" method="post" enctype="multipart/form-data">
    @endif
    
        <label for="imagem" id="conteudoImagem">
            <img @if ($edit) src="{{asset($post->imagem)}}" @else src="{{asset('image/usuario1.png')}}" @endif alt="" class="perfil">
            <span id="nomeImagem">Selecione a foto do post</span>
        </label>
        <input type="file" name="imagem" id="imagem" accept="image/*">
        @csrf
        <input type="text" name="titulo" id="titulo" placeholder="Título" minlength="10" maxlength="50" value="{{$edit ? "$post->titulo" : ''}}" required>
        <input type="text" name="desc" id="desc" placeholder="Descrição" value="{{$edit ? "$post->descricao" : ''}}" minlength="10" maxlength="80" required>
        <textarea name="cod" id="cod" cols="30" rows="10" placeholder="Código HTML" required>{{$edit ? "$post->html" : ''}}</textarea>
        <input type="submit" value="{{$edit ? "Editar" : "Cadastrar"}}" class="enviar">
    </form>
</div>
@endsection
@section('javascript')
    <script src="{{asset('js/form.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script>
        function certeza(nome, id) {
            if (confirm(`Deseja deletar o registro: ${nome}?`)) {
                salvarIdSession('{{route("criadores.salvar.id")}}', '{{route("criadores.delete")}}', id, 3)
            }
        }
    </script>
@endsection
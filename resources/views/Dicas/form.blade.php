@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="formulario">
    <h1>{{$edit ? "Editar" : "Cadastrar"}}</h1>
    @if ($edit)
        <form action="{{route('dicas.edit.post')}}" method="post">
        <a class="btn" onclick="certeza('{{$post->titulo}}', {{$post->id}})" style="align-self: flex-end">Excluir</a>
        <input type="hidden" name="dica_id" value="{{$post->id}}">
    @else
        <form action="{{route('dicas.novo.post')}}" method="post">
    @endif
        @csrf
        <input type="text" name="titulo" id="titulo" placeholder="Título" minlength="10" maxlength="50" value="{{$edit ? "$post->titulo" : ''}}" required>
        <input type="text" name="desc" id="desc" placeholder="Descrição" value="{{$edit ? "$post->descricao" : ''}}" minlength="10" maxlength="80" required>
        <select name="linguagem" id="linguagem" required>
            <option disabled selected value="0">Selecione a linguagem</option>
            <option @if ($edit) @if ($post->linguagem == 'js') selected @endif @endif value="js">Javascript</option>
            <option @if ($edit) @if ($post->linguagem == 'php') selected @endif @endif value="php">PHP</option>
            <option @if ($edit) @if ($post->linguagem == 'java') selected @endif @endif value="java">Java</option>
        </select>
        <textarea name="cod" id="cod" cols="30" rows="10" placeholder="Código HTML" minlength="30" maxlength="16777000" required>{{$edit ? "$post->html" : ''}}</textarea>
        <input type="submit" value="{{$edit ? "Editar" : "Cadastrar"}}" class="enviar">
    </form>
</div>
@endsection
@section('javascript')
    <script>
        function certeza(nome, id) {
            if (confirm(`Deseja deletar o registro: ${nome}?`)) {
                salvarIdSession('{{route("dicas.salvar.id")}}', '{{route("dicas.delete")}}', id, 3)
            }
        }

        $('.enviar').click(function (e) { 
            if($('#linguagem').val() == null) {
                e.preventDefault()
                alert('Selecione uma linguagem!')
            }
        });
    </script>
@endsection
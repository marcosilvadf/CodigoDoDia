@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="perfil">
    <h1>Perfil</h1>
    <img src='{{asset("$usuario->foto")}}' alt="">
    <span>{{$usuario->nome}}</span>
    @if ($usuario->tipo > 0)
        <a class="btn" href="{{route('dicas.lista')}}">Dicas</a>
        <a class="btn" href="{{route('criadores.lista')}}">Criadores</a>
    @endif
    <a class="btn" href="{{route('usuario.edit')}}">Editar Perfil</a>
    <a class="btn" href="{{route('usuario.deslogar')}}">Sair</a>
    <a class="btn" onclick="certeza()">Excluir Perfil</a>
</div>
@endsection

@section('javascript')
    <script src="{{asset('js/form.js')}}?{{getenv('APP_VERSION')}}"></script>
    <script>
        function certeza(){
            if (confirm('Tem certeza que deseja apagar seu perfil? Isso apagará todos os dados e não poderão ser recuperados!')) {
                abrirLink('{{route("usuario.delete")}}', true)
            }
        }
    </script>
@endsection
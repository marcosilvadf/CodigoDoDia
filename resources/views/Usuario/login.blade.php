@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="formulario">
    <h1>Login</h1>
    <form action="{{route('usuario.login.post')}}" method="post">
        @csrf
        <input type="email" name="email" id="email" placeholder="E-mail:" required>
        <input type="password" name="senha" id="senha" placeholder="Senha:" minlength="4" maxlength="20" required>
        <input type="submit" value="login" class="enviar">
    </form>
    <a class="btn" href="{{route('usuario.novo')}}" style="align-self: flex-end">Não tem cadastro?</a>
    <a class="btn" href="{{route('usuario.recuperar')}}" style="align-self: flex-end">Esquceu a senha?</a>
</div>
@endsection
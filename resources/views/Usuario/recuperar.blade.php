@extends('Default.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/form.css')}}?{{getenv('APP_VERSION')}}">
@endsection
@section('section')
<div class="formulario">
    <h1>Recuperar</h1>
    <form action="{{route('usuario.recuperar.post')}}" method="post">
        @csrf
        <input type="email" name="email" id="email" placeholder="E-mail:" required>
        <input type="password" name="senha" id="senha" placeholder="Senha:" minlength="4" maxlength="20" required>
            <input type="password" name="" id="confirmsenha" placeholder="Confirme a Senha:" minlength="4" maxlength="20" required>
        <input type="submit" id="btnSubmit" value="alterar senha" class="enviar">
    </form>
</div>
@endsection
@section('javascript')
    <script>
        $('#btnSubmit').click(function (e) { 
            if ($('#senha').val() != $('#confirmsenha').val()) {
                e.preventDefault()
                alert('Senhas não coincidem!')
            }
        })
    </script>
@endsection
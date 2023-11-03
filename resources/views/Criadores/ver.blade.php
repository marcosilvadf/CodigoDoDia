@extends('Default.layout')
@section('section')
    <div class="postagem ver">
        <h1>{{$post->titulo}}</h1>
        <div class="add-info">
            <span>Autor: {{$post->usuario->nome}}</span>
            <span>{{$post->dataFormatadaUsuario()}}</span>
        </div>
        <p>{{$post->descricao}}</p>
        @php
            echo $post->html;
        @endphp        
    </div>
@endsection

@section('javascript')
    <script src="{{asset('js/verView.js')}}?{{getenv('APP_VERSION')}}"></script>
@endsection
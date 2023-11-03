@extends('Default.layout')
@section('section')
<input type="hidden" id="token" value="{{ csrf_token() }}">
    @foreach ($posts as $post)
        <a href="{{route('dicas.ver', ['slug' => $post->slug])}}">
            <div class="postagem">
                <h1>{{$post->titulo}}</h1>
                <p>{{$post->descricao}}</p>
                <img class="linguagem" src="{{asset('svg/'. $post->linguagem .'.svg')}}" alt="">
            </div>
        </a>
    @endforeach
@endsection

@section('javascript')
    <script>        
        var csrfToken = $('#token').val()
        function removerAdicionarSession(id) {
            return new Promise(resolve => {
                sessionStorage.removeItem("id")
                while (sessionStorage.getItem("id") === null) {
                    sessionStorage.setItem("id", id)
                }
                resolve(sessionStorage.getItem("id"))
            })
        }

        async function guardarIdPostagem(id) {
            var idItem = await removerAdicionarSession(id)
        }        
    </script>
@endsection
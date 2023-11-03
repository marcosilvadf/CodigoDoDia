@extends('Default.layout')
@section('section')
<div class="lista">
    <h1>Lista</h1>    
    <a class="btn" href="{{route('dicas.novo')}}" style="align-self: flex-end">Nova</a>
    <table>
        <tr>
        </tr>
        @foreach ($posts as $post)
            <tr onclick="salvarIdSession('{{route('dicas.salvar.id')}}', '{{route('dicas.edit')}}', '{{$post->id}}', 2)">
                <td>{{$post->titulo}}</td>
                <td><img class="linguagem" src="{{asset('svg/'. $post->linguagem .'.svg')}}" alt=""></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
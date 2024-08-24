@extends('layouts.app')

@section('content')
@if (session('success'))
<div>
    {{ session('success') }}
</div>
@endif
{{  html()->form('GET', route('articles.index'))->open() }}
{{  html()->input('text', 'name') }}
{{  html()->submit('Search') }}
{{ html()->form()->close() }}
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <a href="articles/{{$article->id}}"><h2>{{$article->name}}</h2></a>
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="articles/{{$article->id}}/edit"> Edit </a>
        <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
            @method('delete')
            @csrf
            <button class="btn btn-danger btn-sm"> X </button>
        </form>
    @endforeach
@endsection
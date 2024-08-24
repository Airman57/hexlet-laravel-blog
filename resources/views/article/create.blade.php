@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{ html()->modelForm($article, 'POST', route('articles.store'))->open() }}
    @include('article.form')
    {{ html()->submit('Создать') }}
{{ html()->closeModelForm() }}
{{ html()->submit('Создать') }}
{{ html()->closeModelForm() }}
@endsection
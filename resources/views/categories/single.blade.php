@extends('layout')

@section('content')
    <p>
        <a href="/catalog">Категории</a>
        @foreach ($tree as $category)
            / <a href="/catalog{{$category->link}}">{{$category->title}}</a>
        @endforeach
    </p>
    <p>Id: {{end($tree)->id}}</p>

    @if (count($categoriesArray) > 0)
        <p>Подкатегории:</p>
        <ul>
            @foreach ($categoriesArray as $element)
                @include('categories.list', $element)
            @endforeach
        </ul>
    @else
        <p>Не подкатегорий</p>
    @endif
@endsection
@extends('layout')

@section('content')
    @if (count($categoriesArray) > 0)
        <ul>
            @foreach ($categoriesArray as $element)
                @include('categories.list', $element)
            @endforeach
        </ul>
    @else
        <p>Не данных</p>
    @endif
@endsection
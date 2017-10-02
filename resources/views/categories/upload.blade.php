@extends('layout')

@section('content')
    <p>Загрузите файл с категориями</p>
    <form action="/catalog/parse" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p><input type="file" name="file" autofocus></p>
        <p><input type="submit" value="Загрузить файл"></p>
    </form>
@endsection
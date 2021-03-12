@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')

@section('admin-content')
    <p>Вы действитеьно хотите удалить книгу {{$book->name}}?</p>
    <form class="container mb-3 text-right" action="{{route('admin_books_delete')}}" method="post">
        @csrf
        <input type="hidden" name="book_id" value="{{$book->id}}">
        <a href="{{route('admin_books_index')}}" class="btn btn-primary">Отмена</a>
        <button type="submit" class="btn btn-danger">Удалить!</button>
    </form>
@endsection

@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')


@section('admin-content')
    <form action="{{route('admin_books_store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="book_name" class="form-label">Название книги</label>
            <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Название книги..." required>
        </div>
        <div class="container mb-3 text-right">
            <a href="{{route('admin_books_index')}}" class="btn btn-primary">Отмена</a>
            <button type="submit" class="btn btn-success">Создать</button>
        </div>
    </form>
@endsection

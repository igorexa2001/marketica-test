@extends('admin.layout.master')

@section('title', 'Админ-панель | Книги')

@section('title-buttons')
    <div class="btn-group admin-nav">
        <a href="{{route('admin_books_index')}}" class="btn btn-primary admin-nav-button disabled">Книги</a>
        <a href="{{route('admin_authors_index')}}" class="btn btn-primary admin-nav-button">Авторы</a>
    </div>
@endsection

@section('admin-content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Авторы</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <th scope="row">{{$book->id}}</th>
                    <td>{{$book->name}}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($book->authors as $author)
                                <li>{{$author->name}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-right w-25">
                        <div class="btn-group">
                            <a href="{{route('admin_books_show', ['book_id' => $book->id])}}" class="btn btn-primary">Редактировать</a>
                            <a href="{{route('admin_books_delete_confirmation', ['book_id' => $book->id])}}" class="btn btn-danger">Удалить</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container mb-3 text-right">
            <a href="{{route('admin_books_create')}}" class="btn btn-success">Добавить</a>
        </div>
    </div>
@endsection

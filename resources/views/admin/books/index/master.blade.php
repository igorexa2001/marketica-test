@extends('admin.master')

@section('title', 'Админ-панель | Книги')


@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            <div>
                <h2>Админ-панель | Книги</h2>
            </div>
            <div class="btn-group mr-4 admin-nav">
                <a href="{{route('admin_books_index')}}" class="btn btn-primary admin-nav-button disabled">Книги</a>
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary admin-nav-button">Авторы</a>
            </div>
        </div>
        <hr>
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
                                <a href="{{route('admin_books_show', ['id' => $book->id])}}" class="btn btn-primary">Редактировать</a>
                                <button class="btn btn-danger">Удалить</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container mb-3 text-right">
                <button class="btn btn-success">Добавить</button>
            </div>
        </div>
    </div>
@endsection

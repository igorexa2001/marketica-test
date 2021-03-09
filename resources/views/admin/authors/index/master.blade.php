@extends('admin.master')

@section('title', 'Админ-панель | Авторы')

@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            <div>
                <h2>Админ-панель | Авторы</h2>
            </div>
            <div class="btn-group mr-4 admin-nav">
                <a href="{{route('admin_books_index')}}" class="btn btn-primary admin-nav-button">Книги</a>
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary admin-nav-button disabled">Авторы</a>
            </div>
        </div>
        <hr>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Кол-во книг</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <th scope="row">{{$author->id}}</th>
                            <td>{{$author->name}}</td>
                            <td>{{$author->books->count()}}</td>
                            <td class="text-right w-25">
                                <div class="btn-group">
                                    <a href="{{route('admin_authors_show', ['id' => $author->id])}}" class="btn btn-primary">Редактировать</a>
                                    <a href="{{route('admin_authors_delete_confirmation', ['id' => $author->id])}}" class="btn btn-danger">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container mb-3 text-right">
                <a href="{{route('admin_authors_create')}}" class="btn btn-success">Добавить</a>
            </div>
        </div>
    </div>
@endsection

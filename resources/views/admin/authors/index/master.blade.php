@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')

@section('title-buttons')
    <div class="btn-group admin-nav">
        <a href="{{route('admin_books_index')}}" class="btn btn-primary admin-nav-button">Книги</a>
        <a href="{{route('admin_authors_index')}}" class="btn btn-primary admin-nav-button disabled">Авторы</a>
    </div>
@endsection

@section('admin-content')
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
                            <a href="{{route('admin_authors_show', ['author_id' => $author->id])}}" class="btn btn-primary">Редактировать</a>
                            <a href="{{route('admin_authors_delete_confirmation', ['author_id' => $author->id])}}" class="btn btn-danger">Удалить</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mb-3 text-right">
        <a href="{{route('admin_authors_create')}}" class="btn btn-success">Добавить</a>
    </div>
@endsection

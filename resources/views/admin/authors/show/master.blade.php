@extends('admin.master')

@section('title', 'Админ-панель | Авторы')


@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            <div>
                <h2>Админ-панель | Авторы | {{$author->name}}</h2>
            </div>
            <div class="mr-4">
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Назад</a>
            </div>
        </div>
        <hr>
        <form class="container" action="{{route('admin_authors_update')}}" method="post">
            <input type="hidden" name="id" value="{{$author->id}}">
            <div class="mb-3">
                <label for="name" class="form-label">Имя автора</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя автора..." value="{{$author->name}}" required>
            </div>
            <div class="container mb-3 text-right">
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Отмена</a>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
        <hr>
        <div class="container">
            <h4>Книги этого автора:</h4>
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
                @foreach($author->books as $book)
                    <tr>
                        <th scope="row">{{$book->id}}</th>
                        <td>{{$book->name}}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($book->authors as $bookAuthor)
                                    <li class="{{$bookAuthor->name == $author->name ? 'font-weight-bold' : ''}}">{{$bookAuthor->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-right w-25">
                            <div class="btn-group">
                                <button class="btn btn-primary">Редактировать</button>
                                <button class="btn btn-danger">Удалить</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

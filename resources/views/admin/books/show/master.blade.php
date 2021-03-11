@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')

@section('title-buttons')
    <div>
        <a href="{{route('admin_books_delete_confirmation', ['book_id' => $book->id])}}" class="btn btn-danger">Удалить</a>
    </div>
@endsection

@section('admin-content')
    <form class="container" action="{{route('admin_books_update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$book->id}}">
        <div class="mb-3">
            <label for="book_name" class="form-label">Название книги</label>
            <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Название книги..." value="{{$book->name}}" required>
        </div>
        <div class="container mb-3 text-right">
            <a href="{{route('admin_books_index')}}" class="btn btn-primary">Отмена</a>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
    <hr>
    <div class="container">
        <h4>Авторы этой книги:</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя автора</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($book->authors as $author)
                <tr>
                    <th scope="row">{{$author->id}}</th>
                    <td>{{$author->name}}</td>
                    <td class="text-right w-25">
                        <form class="btn-group" action="{{route('admin_books_detach_author')}}" method="post">
                            @csrf
                            <input type="hidden" name="author_id" value="{{$author->id}}">
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <a href="{{route('admin_authors_show', ['author_id' => $author->id])}}" class="btn btn-primary">Редактировать</a>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if(!$otherAuthors->isEmpty())
                <form action="{{route('admin_books_attach_author')}}" method="post">
                    @csrf
                    <tr>
                        <th></th>
                        <td>
                            <label class="form-label" for="author_selector">Добавить нового автора</label>
                            <select class="form-control" id="author_selector" name="author_id" required>
                                <option value="" selected disabled hidden>Выберите автора из списка...</option>
                                @foreach($otherAuthors as $author)
                                    <option value="{{$author->id}}">{{$author->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-right w-25 align-bottom">
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </td>
                    </tr>
                </form>
            @endif
            </tbody>
        </table>
    </div>
@endsection

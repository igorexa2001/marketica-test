@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')

@section('title-buttons')
    <div>
        <a href="{{route('admin_authors_delete_confirmation', ['author_id' => $author->id])}}" class="btn btn-danger">Удалить</a>
    </div>
@endsection

@section('admin-content')
    <form class="container" action="{{route('admin_authors_update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$author->id}}">
        <div class="mb-3">
            <label for="author_name" class="form-label">Имя автора</label>
            <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Имя автора..." value="{{$author->name}}" required>
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
            @if(!$otherBooks->isEmpty())
                <form action="{{route('admin_authors_attach_book')}}" method="post">
                    @csrf
                    <tr>
                        <th></th>
                        <td colspan="2">
                            <label class="form-label" for="book_selector">Добавить новую книгу</label>
                            <select class="form-control" id="book_selector" name="book_id" required>
                                <option value="" selected disabled hidden>Выберите книгу из списка...</option>
                                @foreach($otherBooks as $book)
                                    <option value="{{$book->id}}">{{$book->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-right w-25 align-bottom">
                            <input type="hidden" name="author_id" value="{{$author->id}}">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </td>
                    </tr>
                </form>
            @endif
            </tbody>
        </table>
    </div>
@endsection

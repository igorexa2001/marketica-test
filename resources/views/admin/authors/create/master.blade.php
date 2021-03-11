@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')


@section('admin-content')
    <form class="container" action="{{route('admin_authors_store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="author_name" class="form-label">Имя автора</label>
            <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Имя автора..." required>
        </div>
        <div class="container mb-3 text-right">
            <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Отмена</a>
            <button type="submit" class="btn btn-success">Создать</button>
        </div>
    </form>
@endsection

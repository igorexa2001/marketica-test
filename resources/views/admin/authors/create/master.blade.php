@extends('admin.master')

@section('title', 'Админ-панель | Авторы')


@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            <div>
                <h2>Админ-панель | Авторы | Создание</h2>
            </div>
            <div class="mr-4">
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Назад</a>
            </div>
        </div>
        <hr>
        <form class="container" action="{{route('admin_authors_store')}}" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Имя автора</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя автора..." required>
            </div>
            <div class="container mb-3 text-right">
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Отмена</a>
                <button type="submit" class="btn btn-success">Создать</button>
            </div>
        </form>
    </div>
@endsection

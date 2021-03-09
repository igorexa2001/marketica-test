@extends('admin.master')

@section('title', 'Админ-панель | Авторы')

@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            <div>
                <h2>Админ-панель | Авторы | {{$author->name}} | Удаление</h2>
            </div>
        </div>
        <hr>
        <div class="container">
            <p>Вы действитеьно хотите удалить автора {{$author->name}}?</p>
            <form class="container mb-3 text-right">
                <input type="hidden" name="id" value="{{$author->id}}">
                <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Отмена</a>
                <button type="submit" class="btn btn-danger">Удалить!</button>
            </form>
        </div>
    </div>
@endsection

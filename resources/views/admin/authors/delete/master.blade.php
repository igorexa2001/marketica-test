@extends('admin.layout.master')

@section('title', 'Админ-панель | Авторы')

@section('admin-content')
    <div class="container">
        <p>Вы действитеьно хотите удалить автора {{$author->name}}?</p>
        <form class="container mb-3 text-right" action="{{route('admin_authors_delete')}}" method="post">
            @csrf
            <input type="hidden" name="author_id" value="{{$author->id}}">
            <a href="{{route('admin_authors_index')}}" class="btn btn-primary">Отмена</a>
            <button type="submit" class="btn btn-danger">Удалить!</button>
        </form>
    </div>
@endsection

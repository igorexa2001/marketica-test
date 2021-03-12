@extends('layout.master')

@section('title', 'Главная страница')

@section('extra_css')
    <style>
        .task-list > li{
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-1">
        <div class="my-3">
            <h2>Тестовое задание на позицию Junior PHP-разработчик в компанию “Маркетика”</h2>
        </div>
        <hr>
        <p>Используя фреймворк Laravel:</p>
        <ol class="task-list">
            <li>
                Реализовать сущности авторы и книги <br>
                <span class="text-muted">Прим.: отношение - many-to-many</span>
            </li>
            <li>Реализовать <a href="{{route('admin_index')}}">административную часть</a>
                <ol type="a">
                    <li>CRUD операции для авторов и книг</li>
                    <li>вывести список книг с обязательным указанием имени автора в списке</li>
                    <li>вывести список авторов с указанием кол-ва книг</li>
                </ol>
            </li>
            <li>Реализовать <a href="{{route('authors_index')}}">публичную часть</a> сайта с отображение авторов и их книг (простой вывод списка на странице)</li>
            <li>Реализовать выдачу данных в формате json по RESTful протоколу отдельным контроллером <br>
                <a href="https://www.getpostman.com/collections/77937ce53c6e9123c24d" target="_blank">(Postman коллекция)</a>
                <ol type="a">
                    <li>GET /api/v1/books/list получение списка книг с именем автора</li>
                    <li>GET /api/v1/books/by-id получение данных книги по id</li>
                    <li>POST /api/v1/books/update обновление данных книги</li>
                    <li>DELETE /api/v1/books/id удаление записи книги из бд</li>
                </ol>
            </li>
        </ol>

        <p>Результат представить ссылкой на репозиторий.<br>
        Желательно, в репозиторий залить пустой каркас приложения, а затем с внесёнными изменениями, чтобы можно было проследить diff.<br>
        <a href="https://github.com/igorexa2001/marketica-test/commits/develop" target="_blank">(Смотреть тут)</a></p>
    </div>
@endsection

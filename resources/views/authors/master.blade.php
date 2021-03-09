@extends('layout.master')

@section('title', 'Авторы')

@section('content')
    <div class="container py-1">
        <div class="my-3">
            <h2>Авторы</h2>
        </div>
        <hr>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Имя автора</th>
                        <th scope="col">Его произведения</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{$author->name}}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($author->books as $book)
                                        <li>{{$book->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

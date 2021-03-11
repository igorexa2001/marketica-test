@extends('layout.master')

@section('extra_css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')
    <div class="container py-1">
        <div class="d-flex justify-content-between my-3">
            @include('admin.layout.breadcrumbs')

            @yield('title-buttons')
        </div>
        <hr>
        @include('admin.layout.message')

        <div class="container">
            @yield('admin-content')
        </div>
    </div>
@endsection

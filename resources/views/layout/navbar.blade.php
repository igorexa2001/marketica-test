<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">
        <a href="{{route('index')}}" class="navbar-brand">{{env('APP_NAME')}}</a>
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{route('index')}}" class="nav-link {{$navPage == 'index' ? 'active' : ''}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('authors_index')}}" class="nav-link {{$navPage == 'authors' ? 'active' : ''}}">Авторы</a>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{route('admin_index')}}" class="nav-link {{$navPage == 'admin' ? 'active' : ''}}">Админ-панель</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

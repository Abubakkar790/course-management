<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0)">CMS</a>
        @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="customersDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="customersDropdown">
                        <li><a href="/dashboard" class="dropdown-item">Home</a></li>
                        <li>
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <ul class="ms-auto navbar-nav">
                <li class="nav-item">
                    <a href="{{route('login')}}" class="btn btn-primary btn-sm" style="width: 100px; border-radius: 16px;"
                        aria-current="page">Login</a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
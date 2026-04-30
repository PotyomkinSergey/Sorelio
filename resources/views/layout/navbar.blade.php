<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Sorelio task manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

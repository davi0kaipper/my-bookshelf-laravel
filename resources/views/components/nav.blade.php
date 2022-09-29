<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/books">My Bookshelf</a>
        <div class="flex">
            <a class="btn btn-outline-light disabled" href="#">
                {{ auth()->user()->name }}
            </a>

            <form method="POST" action="/logout" class="ml-3">
                @csrf
                <button class="btn btn-outline-light" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>

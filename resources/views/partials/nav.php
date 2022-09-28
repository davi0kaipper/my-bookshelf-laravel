<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">My Bookshelf</a>
        <div>

        <a class="btn btn-outline-light disabled" href="#"><?= $user['name']; ?></a>

        <div
        href="#"
        x-data="{}"
        class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white bg-blue-500 text-white"
        @click.prevent="document.querySelector('#logout-form').submit()"
        >Logout</div>

        <form id="logout-form" method="POST" action="/logout" class="hidden">
        @csrf
        </form>
        <a class="btn btn-outline-light" href="../login/logout.php">Logout</a>
        </div>
    </div>
</nav>
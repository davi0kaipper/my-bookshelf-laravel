<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx' crossorigin='anonymous'>
    <link rel="stylesheet" href="http://localhost:8000/public/styles/main.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa' crossorigin='anonymous'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>My Bookshelf - Listagem de Livros</title>
</head>
<body>
    <x-nav/>
    <div class='container'>
        <div class='row mt-3'>
            <div class='col'>
                <div class='mb-3'>
                    <a href='#' class='btn btn-primary'>Cadastrar</a>
                    <button id='remove_selected' class='btn btn-secondary'>Remover selecionados</button>
                    <form action="#" id='remove_form' method="post">
                        <input type='hidden' name='selected' id='selected' value=''>
                    </form>
                </div>
                <?php if (! empty($flashMessage)) : ?>
                    <div class='alert alert-<?= $flashMessage['type']; ?> mb-3 text-center'>
                        <?= $flashMessage['message']; ?>
                    </div>
                <?php endif ?>
                <table class='table'>
                    <thead>
                        <tr>
                            <th><input type='checkbox' id='select_all'></th>
                            <th>Capa</th>
                            <th>Título</th>
                            <th>Autor(es)</th>
                            <th>Gênero</th>
                            <th>Editora</th>
                            <th>Nº de Páginas</th>
                            <th style='width: 200px'>Descrição</th>
                            <th style='width: 200px'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($books) !== 0)
                            @foreach ($books as $book)
                                <tr>
                                    <td><input type='checkbox' class='select_item' value='{{ $book->id }}'></td>
                                    <td><img src="../../public/upload/{{ $book->cover }}"></td>
                                    <td>  {{ $book->name ?? '' }} </td>
                                    <td>  {{ $book->author ?? '' }} </td>
                                    <td>  {{ $book->genre ?? '' }} </td>
                                    <td>  {{ $book->publisher ?? '' }} </td>
                                    <td>  {{ $book->number_of_pages ?? '' }} </td>
                                    <td>  {{ $book->description ?? '' }} </td>
                                    <td>
                                        <a href='#'>Ver</a>
                                        <a href='#'>Editar</a>
                                        <a href='#'>Remover</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan='9' class='text-center'>Nenhum livro encontrado.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>

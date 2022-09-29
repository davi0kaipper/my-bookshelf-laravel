<x-layout title="Listagem de Livros">
    <div class='container'>
        <div class='row mt-3'>
            <div class='col'>
                <div class='mb-3'>
                    <a href='/books/create' class='btn btn-primary'>Cadastrar</a>
                    <button id='remove_selected' class='btn btn-secondary'>Remover selecionados</button>
                    <form action="/books/batch" id='remove_form' method="post">
                        @csrf
                        <input type='hidden' name='selected' id='selected' value=''>
                    </form>
                </div>

                @if (! empty(session('success')))
                    <x-flash message="{{ session('success') }}"/>
                @endif

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
                        @if ($books->count())
                            @foreach ($books as $book)
                                <tr>
                                    <td><input type='checkbox' class='select_item' value='{{ $book->id }}'></td>
                                    <td><img src="storage/{{ $book->cover }}"></td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->genre }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->number_of_pages }}</td>
                                    <td>{{ $book->description }}</td>
                                    <td>
                                        <a href='/books/{{ $book->id }}'>Ver</a>
                                        <a href='/books/{{ $book->id }}/edit'>Editar</a>
                                        <form style="display: inline" method="post" action="/books/{{ $book->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="button-link">Remover</button>
                                        </form>
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
                <div class="mb-4">
                    @if ($books->count())
                        {{ $books->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>

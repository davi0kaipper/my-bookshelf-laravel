<x-layout title="Apresentação de Livro">
    <div class="col-6 container-fluid mt-3 pb-3">
        <div class="row mb-3">
            <label class="col-4 col-form-label" for="photo">Capa</label>
            <div class="col-8">
                <img src="/storage/{{ $book->cover }}">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="title">Título</label>
            <div class="col-8">
                <input type="text" name="title" id="title" value="{{ $book->name }}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="author">Autor(es)</label>
            <div class="col-8">
                <input type="text" name="author" id="author" value="{{ $book->author }}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="genre">Gênero(s)</label>
            <div class="col-8">
                <input type="text" name="genre" id="genre" value="{{ $book->genre }}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="publisher">Editora</label>
            <div class="col-8">
                <input type="text" name="publisher" id="publisher" value="{{ $book->publisher }}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="pages">Número de páginas</label>
            <div class="col-8">
                <input type="text" name="pages" id="pages" value="{{ $book->number_of_pages }}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="is_national">Publicação Nacional</label>
            <div class="col-8">
                <input type="text" name="is_national" id="is_national" value="{{ $book->is_national ? 'Sim' : 'Não'}}" class="form-control" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-4 col-form-label" for="description">Descrição</label>
            <div class="col-8">
                <textarea name="description" id="description" rows="4" class="form-control" readonly>{{ $book->description }}</textarea>
            </div>
        </div>

        <div class="row d-flex">
            <a class="btn btn-primary w-50 mx-auto" href="/" role="button">Voltar</a>
        </div>
    </div>
</x-layout>

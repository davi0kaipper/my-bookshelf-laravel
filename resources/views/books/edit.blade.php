<x-layout title="Edição de Livro">
    <div class="col-6 container-fluid mb-3">
        <x-form-edit :book="$book" action="/books/{{ $book->id }}" formSubmit="Alterar"/>
    </div>
</x-layout>

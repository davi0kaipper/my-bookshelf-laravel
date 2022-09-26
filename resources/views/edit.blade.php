<x-layout title="Edição de Livro">
    <div class="col-6 container-fluid mb-3">
        {{-- <?php require '../partials/validation_message.php'; ?> --}}
        <x-form-edit :book="$book" page="edit" action="/edit/{{ $book->id }}" formSubmit="Alterar"/>
    </div>
</x-layout>

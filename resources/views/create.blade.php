<x-layout title="Registro de Livro">
        <div class="col-6 container-fluid pb-3">
            {{-- <?php require '../partials/validation_message.php'; ?> --}}
            <x-form-create page="create" action="/create" formSubmit="Cadastrar"/>
        </div>
</x-layout>

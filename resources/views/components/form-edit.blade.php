@props(['book', 'page', 'action', 'formSubmit'])
@php
    $genre = $book->genre;
    $genre = explode(', ', $genre);
@endphp
<form action='{{ $action }}' method='post' enctype='multipart/form-data' class="mt-3">
    @csrf
    @method('PATCH')

    @if ($page === 'create')
        <div class='row mb-3'>
            <label class='col-4 col-form-label' for='cover'>Capa</label>
            <div class='col-8'>
                <input type='file' name='cover' id='cover' class='form-control'>
                <x-error name="cover"/>
            </div>
        </div>
    @elseif ($page === 'edit')
        <div class='row mb-3'>
            <label class='col-4 col-form-label' for='photo'>Capa</label>
            <div class='col-8'>
                <img src='/storage/{{ $book->cover }}'>
                <input type='hidden' name='cover' id='cover' value='{{ $book->cover }}'>
                <input type='hidden' name='id' id='id' value='{{ $book->id }}'>
            </div>
        </div>
    @endif

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='name'>Título</label>
        <div class='col-8'>
            <input type='text' name='name' id='name' value="{{ old('name', $book->name) }}" class='form-control'>
            <x-error name="name"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='author'>Autor(es)</label>
        <div class='col-8'>
            <input type='text' name='author' id='author' value='{{ $book->author }}' class='form-control'>
            <x-error name="author"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='number_of_pages'>Número de páginas</label>
        <div class='col-8'>
            <input type='number' name='number_of_pages' id='number_of_pages' value='{{ $book->number_of_pages }}' class='form-control'>
            <x-error name="number_of_pages"/>
        </div>
    </div>

    <div class='row mb-4'>
        <div class='col-4'>
            Gênero(s)
        </div>
        <div class='col-8'>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='action' value='Ação' class='form-check-input' {{ in_array('Ação', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='action'>Ação</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='academic' value='Acadêmico' class='form-check-input' {{ in_array('Acadêmico', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='academic'>Acadêmico</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='adventure' value='Aventura' class='form-check-input' {{ in_array('Aventura', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='adventure'>Aventura</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='science_fiction' value='Ficção Científica' class='form-check-input' {{ in_array('Ficção Científica', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='science_fiction'>Ficção Científica</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='fantasy' value='Fantasia' class='form-check-input' {{ in_array('Fantasia', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='fantasy'>Fantasia</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='religion' value='Religião' class='form-check-input' {{ in_array('Religião', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='religion'>Religião</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='horror' value='Terror' class='form-check-input' {{ in_array('Terror', $genre ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='horror'>Terror</label>
            </div>
            <x-error name="genre"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label'>Publicação Nacional</label>
        <div class='col-8'>
            <div class='form-check'>
                <input type='radio' name='is_national' id='sim' value='1' class='form-check-input' {{ $book->is_national == 1 ? 'checked' : '' }}>
                <label class='form-check-label' for='sim'>Sim</label>
            </div>
            <div class='form-check'>
                <input type='radio' name='is_national' id='nao' value='0' class='form-check-input' {{ $book->is_national == 0 ? 'checked' : '' }}>
                <label class='form-check-label' for='nao'>Não</label>
            </div>
            <x-error name="is_national"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='publisher'>Editora</label>
        <div class='col-8'>
            <input type='text' name='publisher' id='publisher' value='{{ $book->publisher }}' class='form-control'>
            <x-error name="publisher"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='description'>Descrição</label>
        <div class='col-8'>
            <textarea name='description' id='description' rows='4' class='form-control'>{{ $book->description }}</textarea>
            <x-error name="description"/>
        </div>
    </div>

    <div class='row d-flex'>
        <button type='submit' class='btn btn-primary w-50 mx-auto'>{{ $formSubmit }}</button>
    </div>
</form>

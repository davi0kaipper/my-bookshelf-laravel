@props(['action', 'formSubmit'])

<form action='{{ $action }}' method='post' enctype='multipart/form-data' class="mt-3">
    @csrf

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='cover'>Capa</label>
        <div class='col-8'>
            <input type='file' name='cover' id='cover' class='form-control'>
            <x-error name="cover"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='name'>Título</label>
        <div class='col-8'>
            <input type='text' name='name' id='name' value='{{ old('name') }}' class='form-control'>
            <x-error name="name"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='author'>Autor(es)</label>
        <div class='col-8'>
            <input type='text' name='author' id='author' value='{{ old('author') }}' class='form-control'>
            <x-error name="author" nome="autor"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='number_of_pages'>Número de páginas</label>
        <div class='col-8'>
            <input type='number' name='number_of_pages' id='number_of_pages' value='{{ old('number_of_pages') }}' class='form-control'>
            <x-error name="number_of_pages"/>
        </div>
    </div>

    <div class='row mb-4'>
        <div class='col-4'>
            Gênero(s)
        </div>
        <div class='col-8'>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='action' value='Ação' class='form-check-input' {{ in_array('Ação', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='action'>Ação</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='academic' value='Acadêmico' class='form-check-input' {{ in_array('Acadêmico', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='academic'>Acadêmico</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='adventure' value='Aventura' class='form-check-input' {{ in_array('Aventura', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='adventure'>Aventura</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='science_fiction' value='Ficção Científica' class='form-check-input' {{ in_array('Ficção Científica', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='science_fiction'>Ficção Científica</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='fantasy' value='Fantasia' class='form-check-input' {{ in_array('Fantasia', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='fantasy'>Fantasia</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='religion' value='Religião' class='form-check-input' {{ in_array('Religião', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='religion'>Religião</label>
            </div>
            <div class='form-check'>
                <input type='checkbox' name='genre[]' id='horror' value='Terror' class='form-check-input' {{ in_array('Terror', old('genre') ?? []) ? 'checked' : '' }}>
                <label class='form-check-label' for='horror'>Terror</label>
            </div>
            <x-error name="genre"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label'>Publicação Nacional</label>
        <div class='col-8'>
            <div class='form-check'>
                <input type='radio' name='is_national' id='sim' value='1' class='form-check-input' {{ old('is_national') === 1 ? 'checked' : '' }}>
                <label class='form-check-label' for='sim'>Sim</label>
            </div>
            <div class='form-check'>
                <input type='radio' name='is_national' id='nao' value='0' class='form-check-input' {{ old('is_national') === 0 ? 'checked' : '' }}>
                <label class='form-check-label' for='nao'>Não</label>
            </div>
            <x-error name="is_national"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='publisher'>Editora</label>
        <div class='col-8'>
            <input type='text' name='publisher' id='publisher' value='{{ old('publisher') }}' class='form-control'>
            <x-error name="publisher"/>
        </div>
    </div>

    <div class='row mb-3'>
        <label class='col-4 col-form-label' for='description'>Descrição</label>
        <div class='col-8'>
            <textarea name='description' id='description' rows='4' class='form-control'>{{ old('description') }}</textarea>
            <x-error name="description"/>
        </div>
    </div>

    <div class='row d-flex mt-4'>
        <button type='submit' class='btn btn-primary w-50 mx-auto'>{{ $formSubmit }}</button>
    </div>
</form>

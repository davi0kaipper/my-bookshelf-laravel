<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('index', [
            'books' => Book::paginate(10)
        ]);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            return redirect('/');
        }

        return view('show', [
            'book' => $book
        ]);
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'author' => ['required', 'max:255', 'min:3'],
            'number_of_pages' => ['required'],
            'genre' => ['required'],
            'is_national' => ['required'],
            'publisher' => ['required', 'max:255'],
            'description' => ['required', 'min:10'],
            'cover' => ['required', 'image']
        ]);

        $attributes['cover'] = request()->file('cover')->store('upload');

        Book::create($attributes);

        return redirect('/')->with('success', 'Livro cadastrado!');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            return redirect('/');
        }

        return view('edit', [
            'book' => $book
        ]);
    }

    public function update(int $id)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'author' => ['required', 'max:255', 'min:3'],
            'number_of_pages' => ['required'],
            'genre' => ['required'],
            'is_national' => ['required'],
            'publisher' => ['required', 'max:255'],
            'description' => ['required', 'min:10']
        ]);

        $book = Book::find($id);
        $book->update($attributes);

        return redirect('/')->with('success', 'Livro atualizado!');
    }

    public function destroy(int $id)
    {
        $book = Book::find($id);
        $book->delete($book);

        return back()->with('success', 'Livro removido!');
    }

    public function destroyAll()
    {
        $ids = explode(',', request()->all()['selected']);
        $ids = array_map(fn($id) => $id = (int) $id, $ids);

        Book::whereIn('id', $ids)->delete();

        return back()->with('success', 'Livro(s) removido(s)!');
    }
}


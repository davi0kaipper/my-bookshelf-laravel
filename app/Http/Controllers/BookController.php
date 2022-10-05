<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'books' => Book::paginate(10)
        ]);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            return redirect('/books');
        }

        return view('books.show', [
            'book' => $book
        ]);
    }

    public function create()
    {
        return view('books.create');
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

        return redirect('/books')->with('success', 'Livro cadastrado!');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            return redirect('/books');
        }

        return view('books.edit', [
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

        return redirect('/books')->with('success', 'Livro atualizado!');
    }

    public function destroy(int $id)
    {
        $book = Book::find($id);
        $book->delete($book);

        return redirect('/books')->with('success', 'Livro removido!');
    }

    public function destroyAll()
    {
        if (request('selected') === null) {
            return redirect('/books');
        }

        $ids = explode(',', request('selected'));
        $ids = array_map(fn($id) => (int) $id, $ids);

        Book::whereIn('id', $ids)->delete();

        return redirect('/books')->with('success', 'Livro(s) removido(s)!');
    }
}


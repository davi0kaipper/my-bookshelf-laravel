<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Validation\Rule;

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

        return redirect('/')->with('success', 'O livro foi cadastrado!');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return view('index', [
            'books' => Book::paginate(10)
        ]);
    }

    public function show(Book $book)
    {
        return view('show', [
            'book' => $book
        ]);
    }
}


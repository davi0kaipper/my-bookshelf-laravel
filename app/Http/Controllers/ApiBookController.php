<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApiBookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $books = $books->map(fn($book) => $book->toFormattedArray());

        return $books;
    }

    public function show($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            return response('', 404);
        }

        return response()->json($book->toFormattedArray(), 200);
    }

    public function store(Request $request)
    {
        $payload = $request->all();

        try {
            Validator::make($payload, [
                'name' => ['required', 'min:3', 'max:255'],
                'author' => ['required', 'min:3', 'max:255'],
                'number_of_pages' => ['required', 'integer', 'numeric'],
                'genre' => ['required', 'array'],
                'is_national' => ['required', 'boolean'],
                'publisher' => ['required', 'min:3', 'max:255'],
                'description' => ['required', 'min:10', 'max:1000'],
                'cover' => ['required']
            ])->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'type' => 'ValidationError',
                'message' => 'Houve um erro de validação.',
                'errors' => Arr::flatten($e->errors())
            ], 422);
        }

        if (! $this->isAValidGenre($payload['genre'])) {
            return response()->json([
                'type' => 'NonExistentGenre',
                'message' => 'O campo gênero contém um ou mais gêneros não cadastrados no catálogo.'
            ], 400);
        }

        $book = Book::create($payload);

        return response()->json($book->toFormattedArray(), 201);
    }

    public function update(Request $request, int $id)
    {
        $payload = $request->all();

        try {
            Validator::make($payload, [
                'name' => ['required', 'min:3', 'max:255'],
                'author' => ['required', 'min:3', 'max:255'],
                'number_of_pages' => ['required', 'integer', 'numeric'],
                'genre' => ['required', 'array'],
                'is_national' => ['required', 'boolean'],
                'publisher' => ['required', 'min:3', 'max:255'],
                'description' => ['required', 'min:10', 'max:1000'],
                'cover' => ['required']
            ])->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'type' => 'ValidationError',
                'message' => 'Houve um erro de validação.',
                'errors' => Arr::flatten($e->errors())
            ], 422);
        }

        if (! $this->isAValidGenre($payload['genre'])) {
            return response()->json([
                'type' => 'NonExistentGenre',
                'message' => 'O campo gênero contém um ou mais gêneros não cadastrados no catálogo.'
            ], 400);
        }

        $book = Book::find($id);
        $book->update($payload);

        return response()->json($book->toFormattedArray(), 200);
    }

    public function destroy(int $id)
    {
        $book = Book::find($id);
        $book->delete($book);

        return response('', 200);
    }

    private function isAValidGenre($genre): bool
    {
        $intersectedGenres = array_intersect($genre, $this->availableGenres());
        return count($genre) === count($intersectedGenres);
    }

    private function availableGenres(): array
    {
        return [
            'Ação',
            'Acadêmico',
            'Aventura',
            'Ficção Científica',
            'Fantasia',
            'Religião',
            'Terror'
        ];
    }
}


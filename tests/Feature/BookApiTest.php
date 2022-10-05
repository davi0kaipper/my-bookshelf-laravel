<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_books_without_auth_token_should_return_unauthorized()
    {
        $response = $this->get('/api/books');

        $response->assertStatus(401);
    }

    public function test_get_books_should_return_ok()
    {
        Book::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->get('/api/books');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
                'id',
                'name',
                'author',
                'number_of_pages',
                'genre',
                'is_national',
                'publisher',
                'description',
                'cover'
            ]
        ]);
    }

    public function test_get_book_without_auth_token_should_return_unauthorized()
    {
        $response = $this->get('/api/books/1');

        $response->assertStatus(401);
    }

    public function test_get_non_existent_book_should_return_not_found()
    {
        $nonExistentBookId = 1;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->get("/api/books/$nonExistentBookId");

        $response->assertStatus(404);
    }

    public function test_get_book_should_return_ok()
    {
        Book::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->get("/api/books/1");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
            'author',
            'number_of_pages',
            'genre',
            'is_national',
            'publisher',
            'description',
            'cover'
        ]);
    }

    public function test_post_book_with_non_existent_genre_should_return_bad_request()
    {
        $payloadWithInvalidGenre = [
            ...$this->validPayload(),
            'genre' => ['Comédia']
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->post('/api/books', $payloadWithInvalidGenre);

        $response->assertStatus(400);

        $response->assertExactJson([
            'type' => 'NonExistentGenre',
            'message' => 'O campo gênero contém um ou mais gêneros não cadastrados no catálogo.'
        ]);
    }

    public function test_post_book_without_auth_token_should_return_unauthorized()
    {
        $response = $this->post('/api/books', $this->validPayload());

        $response->assertStatus(401);
    }

    public function test_post_book_with_invalid_payload_should_return_unprocessable_entity()
    {
        $invalidPayload = [
            ...$this->validPayload(),
            'is_national' => 'true'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->post('/api/books', $invalidPayload);

        $response->assertStatus(422);

        $response->assertExactJson([
            'type' => 'ValidationError',
            'message' => 'Houve um erro de validação.',
            'errors' => [
                "O campo publicação nacional deve ser verdadeiro ou falso."
            ]
        ]);
    }

    public function test_post_book_should_return_created()
    {
        $payload = $this->validPayload();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->post('/api/books', $payload);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name',
            'author',
            'number_of_pages',
            'genre',
            'is_national',
            'publisher',
            'description',
            'cover'
        ]);
    }

    public function test_update_book_with_non_existent_genre_should_return_bad_request()
    {
        $book = Book::factory()->create();

        $payloadWithInvalidGenre = [
            ...$this->validPayload(),
            'genre' => ['Comédia']
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->put("/api/books/{$book->id}", $payloadWithInvalidGenre);

        $response->assertStatus(400);

        $response->assertExactJson([
            'type' => 'NonExistentGenre',
            'message' => 'O campo gênero contém um ou mais gêneros não cadastrados no catálogo.'
        ]);
    }

    public function test_update_book_without_auth_token_should_return_unauthorized()
    {
        $book = Book::factory()->create();

        $response = $this->put("/api/books/{$book->id}", $this->validPayload());

        $response->assertStatus(401);
    }

    public function test_update_book_with_invalid_payload_should_return_unprocessable_entity()
    {
        $book = Book::factory()->create();

        $invalidPayload = [
            ...$this->validPayload(),
            'is_national' => 'true'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->put("/api/books/{$book->id}", $invalidPayload);

        $response->assertStatus(422)->assertExactJson([
            'type' => 'ValidationError',
            'message' => 'Houve um erro de validação.',
            'errors' => [
                "O campo publicação nacional deve ser verdadeiro ou falso."
            ]
        ]);
    }

    public function test_update_book_should_return_ok()
    {
        $book = Book::factory()->create();

        $payload = $this->validPayload();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->put("/api/books/{$book->id}", $payload);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
            'author',
            'number_of_pages',
            'genre',
            'is_national',
            'publisher',
            'description',
            'cover'
        ]);
    }

    public function test_delete_book_without_auth_token_should_return_unauthorized()
    {
        $book = Book::factory()->create();

        $response = $this->delete("/api/books/{$book->id}");

        $response->assertStatus(401);
    }

    public function test_delete_book_should_return_ok()
    {
        $book = Book::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . config('api.token')
        ])->delete("/api/books/{$book->id}");

        $response->assertStatus(200);
    }

    private function validPayload(): array
    {
        return [
            'name' => 'Sally',
            'author' => 'Reed',
            'number_of_pages' => 153,
            'genre' => ['Aventura', 'Religião'],
            'is_national' => true,
            'publisher' => 'Arqueiro',
            'description' => 'Enim laudantium aut nobis enim.',
            'cover' => 'example-image.png'
        ];
    }
}
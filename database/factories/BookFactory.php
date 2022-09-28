<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genre = ['Ação', 'Acadêmico', 'Aventura', 'Ficção Científica', 'Fantasia', 'Religião', 'Terror'];
        $publishers = ['Penguino', 'Record', 'Globo', 'Atlas', 'Arqueiro'];

        return [
            'name' => $this->faker->name(3),
            'author' => $this->faker->name(3),
            'number_of_pages' => $this->faker->numberBetween(10, 999),
            'genre' => [$this->faker->randomElement($genre)],
            'is_national' => $this->faker->randomElement([0, 1]),
            'publisher' => $this->faker->randomElement($publishers),
            'description' => $this->faker->sentence,
            'cover' => 'upload/SMwxKWR8tMU72xAGvfc9kbtm2BhMGQIholG99tCA.png'
        ];
    }
}
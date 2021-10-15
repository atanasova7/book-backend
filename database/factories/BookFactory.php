<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * 
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => str_replace('.', '', $this->faker->unique()->realText(30)),
            'author' => $this->faker->unique()->name(),
            'release_date' => now()
        ];
    }
}
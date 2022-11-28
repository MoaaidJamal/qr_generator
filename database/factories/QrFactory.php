<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Qr;
use App\Models\User;

class QrFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qr::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->paragraphs(3, true),
            'size' => $this->faker->numberBetween(-10000, 10000),
            'background_color' => $this->faker->hexColor,
            'fill_color' => $this->faker->hexColor,
            'path' => $this->faker->word,
        ];
    }
}

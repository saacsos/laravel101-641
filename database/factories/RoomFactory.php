<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $floor = $this->faker->numberBetween(2, 20);
        return [
            'name' => $this->faker->numerify($floor.'##'),
            'floor' => $floor,
            'type' => $this->faker->randomElement(['SUITE', 'STUDIO', 'LOFT', 'PENTHOUSE']),
        ];
    }
}

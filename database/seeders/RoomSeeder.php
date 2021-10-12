<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::get();
        foreach($apartments as $apartment) {
            Room::factory(5)->create([
                'apartment_id' => $apartment->id
            ]);
        }
    }
}

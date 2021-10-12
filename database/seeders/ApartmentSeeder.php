<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartment = new Apartment();
        $apartment->name = "CS 101";
        $apartment->floors = 4;
        $apartment->save();

        $apartment = new Apartment();
        $apartment->name = "CS 102";
        $apartment->floors = 6;
        $apartment->save();

        $apartment = new Apartment();
        $apartment->name = "CS 103";
        $apartment->floors = 5;
        $apartment->save();

        Apartment::factory(3)->create();
        Apartment::factory()->hasRooms(3)->create();
    }
}

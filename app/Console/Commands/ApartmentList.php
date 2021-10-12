<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ApartmentList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apartment:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List apartment in CSV format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apartments = Http::get('http://localhost:8000/api/apartments');
        $apartments = json_decode($apartments->getBody()->getContents(), true);
        echo "name,floors,created_at\n";
        foreach ($apartments as $apartment) {
            echo "{$apartment['name']},{$apartment['floors']},{$apartment['created_at']}\n";
        }
        return 0;
    }
}

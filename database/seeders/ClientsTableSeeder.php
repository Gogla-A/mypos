<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = ['Abdullah Badawy', 'Mohamed Massoud', 'Safawn Elaasy'];
        foreach ($clients as $client) {
            Client::create([
                'name' => $client,
                'phone' => ['+2 ' . time(), '+2 ' . time()],
                'address' => 'Address of ' . $client,
            ]);

        }
    }
}

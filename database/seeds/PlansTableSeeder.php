<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Empreendedor',
            'description' => 'Plano Empreendedor',
            'price' => 69.9,
        ]);
    }
}

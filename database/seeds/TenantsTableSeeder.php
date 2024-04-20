<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        
        $plan->tenants()->create([
            'cnpj' => '23882706000120',
            'name' => 'Empresa 01',
            'url' => 'empresa01',
            'email' => 'empresa01@mail.com',
        ]);
    }
}

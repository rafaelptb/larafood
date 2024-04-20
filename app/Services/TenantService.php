<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;

class TenantService{
    
    private $plan, $data = [];
    
    public function __construct(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }
    
    public function make()
    {
        $tenant = $this->storeTenant();
        
        $user = $this->storeUser($tenant);
        
        return $user;
    }
    
    public function storeTenant()
    {
        $tenant = $this->plan->tenants()->create([
            'cnpj' => $this->data['cnpj'],
            'name' => $this->data['tenant'],
            'email' => $this->data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
        
        return $tenant;
    }
    
    public function storeUser(Tenant $tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['tenant'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);
        
        return $user;
    }
    
}
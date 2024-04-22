<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Category extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'name',
        'url',
        'description'
    ];

    
    
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
    
    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
    
}
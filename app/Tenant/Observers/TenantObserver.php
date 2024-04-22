<?php

namespace App\Tenant\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\ManagerTenant;

class TenantObserver
{
    
    /**
     * Handle the category "creating" event.
     *
     * @param  \lluminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);
        $model->tenant_id = $managerTenant->getTenantIdentify();
    }
    
}
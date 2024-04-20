<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Profile;

class PlanProfileController extends Controller
{
    
    private $plan, $profile;
    
    public function __construct(Plan $plan, Profile $profile) {
        $this->plan = $plan;
        $this->profile = $profile;
    }
    
    public function profiles($idPlan)
    {
        
        $plan = $this->plan->find($idPlan);
        
        if (!$plan){
            return redirect()->back();
        }
        
        $profiles = $plan->profiles()->paginate();
        
        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }
    
    public function profilesAvailable($idPlan)
    {
        
        if (!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }
        
        $profiles = $plan->profilesAvailable();
        
        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles'));
    }
    
    public function filterProfilesAvailable(Request $request, $idPlan)
    {
        $filters = $request->except('_token');
        
        if (!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }
        
        $profiles = $plan->profilesAvailable($request->filter);
        
        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }
    
    public function attachProfilesPlan(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }
        
        if (!$request->profiles || count($request->profiles) == 0){
            return redirect()->back()
                    ->with('info', 'Necessário escolher ao menos uma permissão.');
        }
        
        $plan->profiles()->attach($request->profiles);
        
        return redirect()->route('plan.profiles', $idPlan);
    }
    
    public function detachProfilePlan($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);
        
        if (!$plan || !$profile){
            return redirect()->back();
        }
        
        $plan->profiles()->detach($profile);
        
        return redirect()->route('plan.profiles', $plan->id)
                ->with('message', 'Desvinculado com sucesso.');
    }
}

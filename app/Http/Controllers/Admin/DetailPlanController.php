<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;

use App\Http\Requests\StoreUpdateDetailRequest;

class DetailPlanController extends Controller
{
    
    protected $repository, $plan;
    
    public function __construct(DetailPlan $detailsPlan, Plan $plan) {
        $this->repository = $detailsPlan;
        $this->plan = $plan;
    }
    
    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        
        $details = $plan->details()->paginate();
        
        return view('admin.pages.plans.details.index', compact('plan', 'details'));
    }
    
    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        
        return view('admin.pages.plans.details.create', compact('plan'));
    }
    
    public function store(StoreUpdateDetailRequest $request, $urlPlan)
    {
        
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        
        $plan->details()->create($request->all());
        
        return redirect()->route('details.plan.index', $urlPlan);
    }
    
    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        
        
        if (!$plan || !$detail){
            return redirect()->back();
        }
        
        return view('admin.pages.plans.details.edit', compact('plan', 'detail'));
    }
    
    public function update(StoreUpdateDetailRequest $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        
        if (!$plan || !$detail){
            return redirect()->back();
        }
        
        $detail->update($request->all());
        
        return redirect()->route('details.plan.index', $urlPlan);
    }
    
    public function show($urlPlan, $idDetail)
    {
        
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        
        if (!$plan || !$detail){
            return redirect()->back();
        }
            
        return view('admin.pages.plans.details.show', compact('plan', 'detail'));
    }
    
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        
        if (!$plan || !$detail){
            return redirect()->back();
        }
        
        $detail->delete();
        
        return redirect()->route('details.plan.index', $urlPlan)
                ->with('message', 'Registro deletado com sucesso.');
    }
}

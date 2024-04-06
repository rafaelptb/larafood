<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Plan;

class PlanController extends Controller
{
    private $repository;
    
    public function __construct(Plan $plan) {
        $this->repository = $plan;
    }
    
    public function index()
    {
        
        $plans = $this->repository->latest()->paginate(15);
        return view('admin.pages.plans.index', compact('plans'));
        
    }
    
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['url'] = Str::kebab($data['name']);
        
        $this->repository->create($data);
            
        return redirect()->route('plans.index');
    }
    
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        
        if (!$plan){
            return redirect()->back();
        }
            
        return view('admin.pages.plans.show', compact('plan'));
    }
    
    public function destroy($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        
        if (!$plan){
            return redirect()->back();
        }
        
        $plan->delete();
        return redirect()->route('plans.index');
    }
}
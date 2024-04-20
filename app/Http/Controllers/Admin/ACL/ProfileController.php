<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $repository;
    
    public function __construct(Profile $profile) {
        $this->repository = $profile;
    }
    
    public function index()
    {
        
        $profiles = $this->repository->latest()->paginate();
        
        return view('admin.pages.profiles.index', compact('profiles'));
        
    }
    
    public function create()
    {
        return view('admin.pages.profiles.create');
    }
    
    public function store(StoreUpdateProfileRequest $request)
    {
        
        $this->repository->create($request->all());
            
        return redirect()->route('profiles.index')
                ->with('message', 'Registro cadastrado com sucesso.');
    }
    
    public function show($id)
    {
        $profile = $this->repository->find($id);
        
        if (!$profile){
            return redirect()->back();
        }
            
        return view('admin.pages.profiles.show', compact('profile'));
    }
    
    public function destroy($id)
    {
        $profile = $this->repository->find($id);
        
        if (!$profile){
            return redirect()->back();
        }
        
        $profile->delete();
        
        return redirect()->route('profiles.index')
                ->with('message', 'Registro deletado com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $profiles = $this->repository->search($request->filter);
        
        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
        
    }
    
    public function edit($id)
    {
        $profile = $this->repository->find($id);
        
        if (!$profile){
            return redirect()->back();
        }
        
        return view('admin.pages.profiles.edit', compact('profile'));
    }
    
    public function update(StoreUpdateProfileRequest $request, $id)
    {
        $profile = $this->repository->find($id);
        
        if (!$profile){
            return redirect()->back();
        }
        
        $profile->update($request->all());
        
        return redirect()->route('profiles.index')
                ->with('message', 'Registro atualizado com sucesso.');
    }
}

<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreUpdatePermissionRequest;

use App\Models\Permission;

class PermissionController extends Controller
{
    private $repository;
    
    public function __construct(Permission $permission) {
        $this->repository = $permission;
    }
    
    public function index()
    {
        
        $permissions = $this->repository->latest()->paginate();
        
        return view('admin.pages.permissions.index', compact('permissions'));
        
    }
    
    public function create()
    {
        return view('admin.pages.permissions.create');
    }
    
    public function store(StoreUpdatePermissionRequest $request)
    {
        
        $this->repository->create($request->all());
            
        return redirect()->route('permissions.index')
                ->with('message', 'Registro cadastrado com sucesso.');
    }
    
    public function show($id)
    {
        $permission = $this->repository->find($id);
        
        if (!$permission){
            return redirect()->back();
        }
            
        return view('admin.pages.permissions.show', compact('permission'));
    }
    
    public function destroy($id)
    {
        $permission = $this->repository->find($id);
        
        if (!$permission){
            return redirect()->back();
        }
        
        $permission->delete();
        
        return redirect()->route('permissions.index')
                ->with('message', 'Registro deletado com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $permissions = $this->repository->search($request->filter);
        
        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
        
    }
    
    public function edit($id)
    {
        $permission = $this->repository->find($id);
        
        if (!$permission){
            return redirect()->back();
        }
        
        return view('admin.pages.permissions.edit', compact('permission'));
    }
    
    public function update(StoreUpdatePermissionRequest $request, $id)
    {
        $permission = $this->repository->find($id);
        
        if (!$permission){
            return redirect()->back();
        }
        
        $permission->update($request->all());
        
        return redirect()->route('permissions.index')
                ->with('message', 'Registro atualizado com sucesso.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $repository;
    
    public function __construct(User $user) {
        $this->repository = $user;
    }
    
    public function index()
    {
        
        $users = $this->repository->latest()->tenantUser()->paginate();
        
        return view('admin.pages.users.index', compact('users'));
        
    }
    
    public function create()
    {
        return view('admin.pages.users.create');
    }
    
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->all();
        
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);
        
        $this->repository->create($data);
            
        return redirect()->route('users.index')
                ->with('message', 'Registro cadastrado com sucesso.');
    }
    
    public function show($id)
    {
        $user = $this->repository->tenantUser()->find($id);
        
        if (!$user){
            return redirect()->back();
        }
            
        return view('admin.pages.users.show', compact('user'));
    }
    
    public function destroy($id)
    {
        $user = $this->repository->tenantUser()->find($id);
        
        if (!$user){
            return redirect()->back();
        }
        
        $user->delete();
        
        return redirect()->route('users.index')
                ->with('message', 'Registro deletado com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);
        
        return view('admin.pages.users.index', compact('users', 'filters'));
        
    }
    
    public function edit($id)
    {
        $user = $this->repository->tenantUser()->find($id);
        
        if (!$user){
            return redirect()->back();
        }
        
        return view('admin.pages.users.edit', compact('user'));
    }
    
    public function update(StoreUpdateUserRequest $request, $id)
    {
        $user = $this->repository->tenantUser()->find($id);
        
        if (!$user){
            return redirect()->back();
        }
        
        $data = $request->only(['name', 'email']);
        
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }
        
        $user->update($data);
        
        return redirect()->route('users.index')
                ->with('message', 'Registro atualizado com sucesso.');
    }
}

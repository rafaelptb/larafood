<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Permission;

class PermissionProfileController extends Controller
{
    
    private $profile, $permission;
    
    public function __construct(Profile $profile, Permission $permission) {
        $this->profile = $profile;
        $this->permission = $permission;
    }
    
    public function permissions($idProfile)
    {
        
        $profile = $this->profile->find($idProfile);
        
        if (!$profile){
            return redirect()->back();
        }
        
        $permissions = $profile->permissions()->paginate();
        
        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }
    
    public function permissionsAvailable($idProfile)
    {
        
        if (!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }
        
        $permissions = $profile->permissionsAvailable();
        
        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }
    
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }
        
        if (!$request->permissions || count($request->permissions) == 0){
            return redirect()->back()
                    ->with('info', 'Necessário escolher ao menos uma permissão.');
        }
        
        $profile->permissions()->attach($request->permissions);
        
        return redirect()->route('profile.permissions', $idProfile);
    }
}

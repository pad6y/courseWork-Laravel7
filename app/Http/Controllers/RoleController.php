<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //
    public function index(){
        
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);

    }
    
    public function edit(Role $role){
        
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }
    
    
    public function store(){
        
        request()->validate([
           'name'=> ['required'] 
        ]);
        
        Role::create([
           'name' => Str::ucfirst(request('name')),
           'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }
    
    public function update(Role $role){
        
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');
        
        if($role->isDirty('name')){
            
            session()->flash('role-updated', request('name').' Role updated successfully');
            $role->save();
            
        }else {
            
            session()->flash('role-unchanged', request('name').' Role was not edited');
            
        }
        
        
        
        return back();
    }
    
    public function attach_permission(Role $role){
        
        $role->permissions()->attach(request('permission'));
        
        return back();
    }
    
    public function detach_permission(Role $role){
        
        $role->permissions()->detach(request('permission'));
        
        return back();
    }
    
    public function destroy(Role $role){
        
        // $this->authorize('delete', $role);
        $role->delete();
        
        Session::flash('role-delete', $role->name.' role has been deleted');
        
        return back();
    }
}

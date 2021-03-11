<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    //
    public function index(){
        
        return view('admin.permissions.index', [
            'permissions' => Permission::all(),
        ]);

    }
    
    
    public function store(){
        
        request()->validate([
            'name'=> ['required'] 
         ]);
         
         Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
         ]);
         return back();

    }
    
    
    public function edit(Permission $permission){
        
        return view('admin.permissions.edit', ['permission'=>$permission]);
    }
    
    
    public function update(Permission $permission){
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');
        
        if($permission->isDirty('name')){
            
            session()->flash('permission-updated', request('name').' Permissions updated successfully');
            $permission->save();
            
        }else {
            
            session()->flash('permission-unchanged', request('name').' Permissions was not edited');
            
        }
        
        return back();
    }
    
    
    public function destroy(Permission $permission){
        
        $permission->delete();
        
        Session::flash('permission-delete', $permission->name.' permission has been deleted');
        
        return back();
    }
}

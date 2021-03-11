<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index(){
        
        $users = User::all();
        
        return view('admin.users.index', ['users'=>$users]);
    }
    
    public function show(User $user) {
        
        return view('admin.users.profile', [
            'user'=> $user,
            'roles'=> Role::all()
            ]);
    }
    
    public function update(User $user){
        
        
        $inputs = request()->validate([
            
            'username'=> ['required', 'string', 'max:255', 'alpha_dash'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar'=> ['file']
            
            
        ]);
        
        if(request('avatar')){
            
            $inputs['avatar'] = request('avatar')->store('images');
        
        }
        $user->update($inputs);
        
        return back();
    }
    
    public function attach(User $user){
        
        $user->roles()->attach(request('role'));
        
        return back();
        
    }
    
    public function detach(User $user){
        
        $user->roles()->detach(request('role'));
        
        return back();
        
    }
    
    public function destroy(User $user){
        
        // $this->authorize('delete', $user);
        $user->delete();
        
        Session::flash('message', 'User has been deleted');
        
        return back();
        
    }
}

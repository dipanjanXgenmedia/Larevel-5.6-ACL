<?php

namespace LaraACL\Http\Controllers;

use Illuminate\Http\Request;
use LaraACL\User as User;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //

    public function index()
    {
    	$users = User::all();
    	return view('user.index',['users' => $users ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create',['roles'=>$roles]);
    }

    public function store()
    {
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email|unique:users',
            'pass' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput(Input::except('pass'));
        } else {
            // store
            $user = new User;
            $user->name     = Input::get('name');
            $user->email    = Input::get('email');
            $user->password = bcrypt(Input::get('pass'));
            $user->save();
            $user->assignRole(Input::get('role'));
            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('user');
        }
    }

    public function edit($id)
    {
    	$user = User::with(['roles'])->where('id',$id)->get()->first();
        //return $user;
        $roles = Role::all();
    	return view('user.edit',['user' => $user,'roles'=>$roles]);
    }


    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email|unique:users,email,'.$id,
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('user/edit/'.$id)
                ->withErrors($validator)
                ->withInput(Input::except('pass'));
        } else {
            // store
            $user = User::find($id);
            $user->name     = Input::get('name');
            $user->email    = Input::get('email');
            if(Input::get('pass')){
             $user->password = bcrypt(Input::get('pass'));    
            }
            $user->save();
            $user->assignRole(Input::get('role'));
            // redirect
            Session::flash('message', 'Successfully edited user!');
            return Redirect::to('user');
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        // redirect
        Session::flash('message', 'Successfully deleted user!');
        return Redirect::to('user');
    }


    public function permission($id)
    {
        $user = User::with(['roles'])->where('id',$id)->get()->first();
        //return $user; die;
        $permissions = Permission::with(['users'=> function($q) use($id) {
                $q->where('users.id',$id);
        },'roles'=>function($r) use($user) {
                $r->where('roles.id',$user->roles[0]->id);
        }])->get();
        
        // View Load
        return view('user.permission',['permissions'=>$permissions]);
    }

    public function permissionUpdate($id)
    {
            // As Add Permission Not Working 
            $user = User::find($id);
            $user_permissions = Input::get('user_permission');
            $user->permissions()->detach();
            if(isset($_POST['user_permission']) && count($user_permissions)){
                foreach ($user_permissions as $permission_id ) {
                     $permission = Permission::find($permission_id);
                     $user->permissions()->save($permission);
                }
            }
         // redirect
        Session::flash('message', 'Successfully updated permission!');
        return Redirect::to('user/permission/'.$id);   
    }

    public function test()
    {
        $user = User::find(3);
        //print_r($user);
        //return $user->getPermissions();
        var_dump($user->is('guest'));
        //var_dump($user->can('index.user'));

        // Perfect
        //$admin = Role::find(3); 
        //return $admin->getPermissions();
        //var_dump($admin->can('index.role'));



    }
}

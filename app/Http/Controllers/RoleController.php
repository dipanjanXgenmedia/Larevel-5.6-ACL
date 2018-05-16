<?php

namespace LaraACL\Http\Controllers;

use Illuminate\Http\Request;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //

    public function index()
    {
        $roles = Role::all();
        return view("role.index",['roles'=>$roles]);
    }

    public function create()
    {
        return view("role.create");
    }

    public function store()
    {
        $rules = array(
            'role'       => 'required',
            'slug'      => 'required|unique:roles',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('role/create')
                ->withErrors($validator);
        } else {
            // store
            $role = new Role;
            $role->name     = Input::get('role');
            $role->slug    = Input::get('slug');
            $role->description    = Input::get('description');
            $role->save();
            // redirect
            Session::flash('message', 'Successfully created role!');
            return Redirect::to('role');
        }   
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view("role.edit",['role'=>$role]);
    }

    public function update($id)
    {
        $rules = array(
            'role'       => 'required',
            'slug'      => 'required|unique:roles,slug,'.$id,
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('role/edit/'.$id)
                ->withErrors($validator);
        } else {
            // store
            $role = Role::find($id);
            $role->name  = Input::get('role');
            $role->slug  = Input::get('slug');
            $role->description = Input::get('description');
            $role->save();
            // redirect
            Session::flash('message', 'Successfully edited role!');
            return Redirect::to('role');
        } 
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        // redirect
        Session::flash('message', 'Successfully deleted role!');
        return Redirect::to('role');
    }


    public function permission($id)
    {
        $permissions = Permission::with(['roles'=> function($q) use($id) {
                                    $q->where('roles.id',$id);
                                }])->get();
        // return $permissions;
        return view('role.permission',['permissions'=>$permissions]);
    }

    public function permissionUpdate($id)
    {
         $roleAssignedpermission = Role::where('id',$id)->with(['permissions'])->get()->first();
         $p_names = [];
         foreach ($roleAssignedpermission->permissions as $key => $permission) {
            $p_names[] = $permission->name;
         }

         $role_permission = Role::find($id);
         $roles = Input::get('role_permission');
         if(count($p_names))
            $role_permission->revokePermission($p_names); // fetach all permission assigned
         $role_permission->assignPermission($roles);
        
        // Redirect
        Session::flash('message', 'Successfully updated permission!');
        return Redirect::to('role/permission/'.$id);
    }
}

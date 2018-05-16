<?php

namespace LaraACL\Http\Controllers;

use Illuminate\Http\Request;
use Kodeine\Acl\Models\Eloquent\Permission;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index()
    {
    	$permissions = Permission::all();
        return view('permission.index',['permissions' => $permissions ]);
    }

    public function create()
    {
    	return view('permission.create');
    }

    public function store()
    {
    	$rules = array(
            'name'       => 'required',
            'slug'      => 'required',
            'description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('permission/create')
                ->withErrors($validator);
        } else {
            // store
            	$slugs = Input::get('slug');
            	$slug_array = explode(",", $slugs);
            	$onlySlugArray  = array();
            	foreach ($slug_array as $key => $slug) {
            		if($slug != '')
            			$onlySlugArray[$slug] = true;
            	}
	            $permission = new Permission;
	            $permission->name = Input::get('name');
	            $permission->slug = $onlySlugArray;
	            $permission->description = Input::get('description');
	            $permission->save();
            // redirect
            	Session::flash('message', 'Successfully created permission!');
            	return Redirect::to('permission');
        }
    }

    public function edit($id)
    {
    	$permission = Permission::find($id);
    	return view('permission.edit',['permission'=>$permission]);
    }

    public function update($id)
    {
    	$rules = array(
            'name'       => 'required',
            'slug'      => 'required',
            'description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('permission/edit/'.$id)
                ->withErrors($validator);
        } else {
            // store
            	$slugs = Input::get('slug');
            	$slug_array = explode(",", $slugs);
            	$onlySlugArray  = array();
            	foreach ($slug_array as $key => $slug) {
            		if($slug != '')
            			$onlySlugArray[$slug] = true;
            	}
	            $permission = Permission::find($id);
	            
	            $permission->name = Input::get('name');
	            $permission->slug = $onlySlugArray;
	            $permission->description = Input::get('description');
	            $permission->save();
            // redirect
            	Session::flash('message', 'Successfully updated permission!');
            	return Redirect::to('permission');
        }
    }

    public function destroy($id)
    {
    	$permission = Permission::find($id);
        $permission->delete();
        // redirect
        Session::flash('message', 'Successfully deleted permission!');
        return Redirect::to('permission');
    }
}

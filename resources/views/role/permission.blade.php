@extends("layouts.layout_main")

@section('title')
Role Permission:: Lara ACL
@endsection

@section('content')
	<div class="row">
        <div class="col-sm-2">
        
        </div>
        <div class="col-sm-10">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}"> Home </a></li>
                  <li class="breadcrumb-item"><a href="{{ URL::to('/role') }}"> Role </a></li>
                  <li class="breadcrumb-item active" aria-current="page">Permission</li>
                </ol>
              </nav>
              @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
              <form action="{{ URL::to('role/permissionupdate/'.Request::segment(3)) }}" method="post" >
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Description</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                            <tr>
                              <th scope="row">1</th>
                              <td>{{ $permission->name }}</td>
                              <?php [$keys, $values] = array_divide($permission->slug); ?>
                              <td>{{ $aa = implode(",", $keys)  }}</td>
                              <td>{{ $permission->description }}</td>
                              <td>
                                  <input type="checkbox" name="role_permission[]" value="{{ $permission->name }}" {{ count($permission->roles) > 0 ? "checked" : ""}} >
                      	      
                              </td>
                            </tr>
                    @endforeach
                  </tbody>
                 </table>
                 <div class="col-sm-11">
                    <hr>
                   <button type="submit" class="btn btn-primary float-right">Save</button>
                 </div>
              </form>
        </div>
    </div>
@endsection
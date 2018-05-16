@extends("layouts.layout_main")

@section('title')
User :: Lara ACL
@endsection


@section('content')
	<div class="row">
		<div class="col-sm-2">
		<!-- Lorem Ipsum -->
		</div>			
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">User</li>
			  </ol>
			</nav>

                        @if (Session::has('message'))
			    <div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
                        <div class="col-sm-9">
	                        <div class="float-right">
	                        	<a href="{{ URL::to('/user/create') }}"> Create User </a> 
	                        </div>
	                    </div>
			<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody>
                            @foreach($users as $user)
				    <tr>
				      <th scope="row">1</th>
				      <td>{{ $user->name }}</td>
				      <td>{{ $user->email }}</td>
				      <td>
                                      	    <a href="{{ URL::to('user/edit/'.$user->id) }}" class="btn btn-sm btn-primary" title="Edit">edit</a>		
                                      	    <a href="{{ URL::to('user/delete/'.$user->id) }}" class="btn btn-sm btn-danger" title="Delete">delete</a>		
                                            <a href="{{ URL::to('user/permission/'.$user->id) }}" class="btn btn-sm btn-info" title="Permission">Permission</a> 
                                      </td>
				    </tr>
                            @endforeach
			  </tbody>
			</table>
		</div>			
	</div>
@endsection
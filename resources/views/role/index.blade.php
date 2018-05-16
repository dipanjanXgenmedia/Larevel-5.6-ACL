@extends("layouts.layout_main")

@section("title")
Role :: Lara ACL
@endsection


@section("content")
<div class="row">
		<div class="col-sm-2">
		<!-- Lorem Ipsum -->
		</div>			
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Role</li>
			  </ol>
			</nav>
                        <div class="col-sm-9">
                        		<div class="float-right">
		                                <a href="{{ URL::to('/role/create') }}"> Create Role </a> 
		                        </div>	
                        </div>
                         
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif

			<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">First</th>
			      <th scope="col">Last</th>
			      <th scope="col">Handle</th>
			    </tr>
			  </thead>
			  <tbody>
			    @foreach($roles as $role)
	                            <tr>
				      <th scope="row">1</th>
				      <td> {{ $role->name }} </td>
				      <td> {{ $role->slug }} </td>
				      <td>
                                      	     <a href="{{ URL::to('role/edit/'.$role->id) }}" class="btn btn-sm btn-primary" title="Edit">edit</a>                
                                            <a href="{{ URL::to('role/delete/'.$role->id) }}" class="btn btn-sm btn-danger" title="Delete">delete</a> 
                                            <a href="{{ URL::to('role/permission/'.$role->id) }}" class="btn btn-sm btn-info" title="Permission">Permission</a> 

                                      </td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>			
	</div>
@endsection
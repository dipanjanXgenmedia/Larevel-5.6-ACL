@extends('layouts.layout_login')

@section('title')
Login :: LARA ACL
@endsection


@section('content')
<div class="modal-dialog" role="document">
	    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Login</h5>
		      </div>
		      <div class="modal-body">
		        	<form>
					    <div class="form-group row">
						    <label for="email" class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="password" class="col-sm-2 col-form-label">Password</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
						    </div>
					    </div>
					    <div class="form-group row">
						    <div class="offset-sm-2 col-sm-10">
						      <div class="form-check">
						        <input class="form-check-input" type="checkbox" id="remember_me" name="remember_me">
						        <label class="form-check-label" for="remember_me"> Remember Me </label>
						      </div>
						    </div>
					    </div>
					    <div class="form-group row">
						    <div class="offset-sm-2 col-sm-10">
						      <button type="submit" class="btn btn-large btn-primary">Sign in</button>
						    </div>
					    </div>
					</form>
		      </div>
		      <div class="modal-footer">
		      		Lara ACL&copy; {{ date("Y") }}
		      </div>
	    </div>
</div>
@endsection
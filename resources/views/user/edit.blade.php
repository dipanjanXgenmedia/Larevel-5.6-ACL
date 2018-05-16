@extends("layouts.layout_main")

@section('title')
User Edit :: Lara ACL
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
                            <li class="breadcrumb-item"><a href="{{ URL::to('/user') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                          </ol>
                        </nav>
                        <!--  Form -->
                        @if ($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                       <form method="post" action="{{ URL::to('user/update/'.$user->id) }}">
                            <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $user->name }}">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="pass" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="pass" class="col-sm-2 col-form-label">Role</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="role" id="role">
                                    @foreach($roles as $role)
                                      <option value="{{ $role->slug }}" {{ $role->slug == $user->roles[0]->slug ? "selected" : "" }}>{{ $role->name }}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Create User</button>
                              </div>
                            </div>
                          </form>
                </div>                  
        </div>
@endsection
@extends("layouts.layout_main")

@section('title')
Permission Edit:: Lara ACL
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
                            <li class="breadcrumb-item"><a href="{{ URL::to('/permission') }}" title="">Permission</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permission Edit</li>
                          </ol>
                        </nav>
                        @if ($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <!--  Form -->
                       <form method="POST" action="{{ URL::to('permission/update/'.$permission->id) }}">
                            <div class="form-group row">
                              <label for="name" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name}}" placeholder="Permission" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                              <div class="col-sm-10">
                                <?php [$keys, $values] = array_divide($permission->slug); ?>
                                <input type="text" class="form-control" value="{{ implode(",", $keys) }}" id="slug" name="slug" placeholder="Slug"  />
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="slug" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Description">{{ $permission->description }}</textarea>
                              </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                            </div>
                          </form>
                </div>                  
        </div>
@endsection
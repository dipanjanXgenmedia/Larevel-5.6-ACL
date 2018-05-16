@extends("layouts.layout_main")

@section('title')
Permission :: Lara ACL
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
                            <li class="breadcrumb-item active" aria-current="page">Permission</li>
                          </ol>
                        </nav>

                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-sm-9">
                                <div class="float-right">
                                        <a href="{{ URL::to('/permission/create') }}"> Create Permission </a> 
                                </div>
                            </div>
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
                                      <td>{{ $aa = implode(",", $keys) }}</td>
                                      <td>{{ $permission->description }}</td>
                                      <td>
                                            <a href="{{ URL::to('permission/edit/'.$permission->id) }}" class="btn btn-sm btn-primary" title="Edit">edit</a>                
                                            <a href="{{ URL::to('permission/delete/'.$permission->id) }}" class="btn btn-sm btn-danger" title="Delete">delete</a>           
                                      </td>
                                    </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>                  
        </div>
@endsection
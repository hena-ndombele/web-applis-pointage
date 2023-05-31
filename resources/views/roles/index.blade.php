@extends('layouts.app')
@section('title')
    <span>Role</span>
@endsection
@section('content')


<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <a class="btn btn-outline-default border" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"></i></a><br>
                </div>
            </div>
        </div><br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-body p-0">
              <table class="table table-striped projects text-center" >
                  <thead>
                      <tr>
                          <th style="width: 1%">
                              #
                          </th>
                          <th style="width: 50%">
                              Role
                          </th>
                          <th  style="width: 50%" class="text-center col-lg-6">
                            Actions
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-center  col-lg-6">
                                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                    <a class="btn btn-outline-primary fas fa-folder" href="{{ route('roles.show',$role->id) }}"></a>
                                    {{--  <a class="btn btn-outline-success" href="{{ route('roles.edit', $role->id) }}"><i class="fas fa-pencil-alt"></i></a>  --}}
                                    @sda('delete', 'User')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    @endsda
                                </form>
                            </td>
                        </tr>
                        @endforeach
                      </tr>
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="d-flex justify-content-center pagination-lg">
            {!! $roles->links('pagination::bootstrap-4') !!}
              </div>
    </div>

</div>

@endsection
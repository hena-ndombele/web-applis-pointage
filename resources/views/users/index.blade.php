@extends('layouts.app')
@section('title')
    <span>Liste des Utilisateurs</span>
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôles</th>
                            
                            <th>Action</th>

                            
                            
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @if (!$user->hasRole('admin'))
                            <tr>
                                <td> {{$user->name }} </td>
                                <td> {{$user->email }} </td>
                                <td> 
                                    @foreach($user->roles as $role)
                                        <a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a>, 
                                    @endforeach
                                </td>
                                <td>
                                    @permission("update",'User')
                                    <a href=" {{route('users.edit', $user->id)}} "><button class=" btn btn-default"><i class="fas fa-pencil-alt"></i></button></a>
                                    @endpermission
                                    @permission('delete', 'User')
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
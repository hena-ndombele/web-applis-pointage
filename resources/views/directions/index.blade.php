@extends('layouts.app')
@section('title')
    <span>Direction</span>
@endsection
@section('content')


<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ol class=" float-sm-right">
                    @permission('create','Direction')
                    <a class="btn btn-light" href="#" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus-circle"></i></a>
                    @endpermission
                </ol>
            </div>
            </div>
        </div><br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card">
            <div class="card-body p-0">
              <table class="table table-striped projects text-center" >
                <thead>
                    <tr>
                        <th class="text-center col-lg-1">
                            Id
                        </th>
                        <th class="text-center col-lg-9">
                            Directions
                        </th>
                        <th class="text-right col-lg-2">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center col-lg-1">
                        @foreach ($directions as $direction)
                    
                     

                          <td class="text-center">{{ $direction->id }}</td>
                          <td class="text-center col-lg-9">{{ $direction->name }}</td>

                 
                        <td class="text-right  col-lg-2">
                            <form action="{{ route('directions.destroy',$direction->id) }}" method="POST">
                                @permission('update','Direction')
                                <a class="btn btn-outline-primary fas fa-folder"  data-toggle="modal" data-target="#edit-{{$direction->id}}" href="#"></a>

                                @endpermission
                                @permission('delete', 'Direction')
                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{ $direction->id }}">
                                    <i class="fas fa-trash" form="delete-{{ $direction->id }}"></i>
                                </a>
                                @endpermission
                            </form>
                        </td>
                       
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="d-flex justify-content-center pagination-lg">
            {!! $directions->links('pagination::bootstrap-4') !!}
              </div>
    </div>

</div>

@endsection

</div>

@include('directions.create')
@include('directions.delete')
@include('directions.edit')



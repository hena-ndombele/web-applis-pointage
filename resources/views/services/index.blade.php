@extends('layouts.app')
@section('title')
    <span>Service</span>
@endsection
@section('content')


<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ol class=" float-sm-right">
                    @permission('create','Service')
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
                        <th class="text-center col-lg-3">
                           Services
                        </th>
                        <th class="text-center col-lg-3">
                            Departements
                        </th>
                        <th class="text-center col-lg-3">
                            Directions
                        </th>
                        <th class="text-right col-lg-2">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center col-lg-1">
                        @foreach ($services as $service)
                    
                     

                          <td class="text-center">{{ $service->id }}</td>
                          <td class="text-center col-lg-3">{{ $service->name }}</td>
                          <td class="text-center col-lg-3">{{ $service->departements->name }}</td>
                          <td class="text-center col-lg-3">{{ $service->directions->name }}</td>
                        

                 
                        <td class="text-right  col-lg-2">
                            <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                @permission('update','Service')
                                <a class="btn btn-outline-primary fas fa-folder"  data-toggle="modal" data-target="#edit-{{$service->id}}" href="#"></a>

                                @endpermission
                                @permission('delete', 'Service')
                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{ $service->id }}">
                                    <i class="fas fa-trash" form="delete-{{ $service->id }}"></i>
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
            {!! $services->links('pagination::bootstrap-4') !!}
              </div>
    </div>

</div>

@endsection

</div>

@include('services.create')
@include('services.delete')
@include('services.edit')



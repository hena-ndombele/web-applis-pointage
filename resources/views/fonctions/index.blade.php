@extends('layouts.app')
@section('title')
    <span>Fonctions</span>
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
                            Fonction
                        </th>
                        <th class="text-right col-lg-2">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center col-lg-1">
                        @foreach ($fonctions as $fonction)
                          <td class="text-center">{{ $fonction->id }}</td>
                          <td class="text-center col-lg-9">{{ $fonction->name }}</td>

                 
                        <td class="text-right  col-lg-2">
                            <form action="{{ route('directions.destroy',$fonction->id) }}" method="POST">
                                <a class="btn btn-outline-primary fas fa-folder"  data-toggle="modal" data-target="#edit-{{$fonction->id}}" href="#"></a>
                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{ $fonction->id }}">
                                    <i class="fas fa-trash" form="delete-{{ $fonction->id }}"></i>
                                </a>
                                
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
            {!! $fonctions->links('pagination::bootstrap-4') !!}
              </div>
    </div>

</div>

@endsection

</div>

@include('fonctions.create')
@include('fonctions.delete')
@include('fonctions.edit')



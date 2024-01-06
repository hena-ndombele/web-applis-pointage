@extends('layouts.app')
@section('title')
    <span>Grades</span>
@endsection
@section('content')


<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <ol class=" float-sm-right">
                    <a class="btn btn-light" href="#" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus-circle"></i></a>
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
                                Grade
                            </th>
                            <th class="text-right col-lg-2">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center col-lg-1">
                            @foreach ($grades as $grade)
                            <td class="text-center">{{ $grade->id }}</td>
                            <td class="text-center col-lg-9">{{ $grade->name }}</td>

                    
                            <td class="text-right  col-lg-2">
                                <form action="{{ route('directions.destroy',$grade->id) }}" method="POST">
                                    <a class="btn btn-outline-primary fas fa-folder"  data-toggle="modal" data-target="#edit-{{$grade->id}}" href="#"></a>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete-{{ $grade->id }}">
                                        <i class="fas fa-trash" form="delete-{{ $grade->id }}"></i>
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
            {!! $grades->links('pagination::bootstrap-4') !!}
            </div>
    </div>

</div>

@endsection

</div>

@include('grades.create')
@include('grades.delete')
@include('grades.edit')



@extends('layouts.app')
@section('title')
    <span>Contrats</span>
@endsection
@section('content')


    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <ol class=" float-sm-right">
                        @permission('create', 'Direction')
                            <a class="btn btn-light" href="#" data-toggle="modal" data-target="#modal-ajout-contrat"><i
                                    class="fas fa-plus-circle"></i></a>
                        @endpermission
                    </ol>
                </div>
            </div>
        </div><br>
        @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contrats as $contrat)
                            <tr class="text-center col-lg-1">
                                <td>{{ $contrat->name }}</td>
                                <td>{{ $contrat->description }}</td>
                                <td>{{ Carbon\Carbon::parse($contrat->date)->format('d-m-Y') }}</td>
                                <td>
                                    <a class="btn btn-outline-primary " data-toggle="modal"
                                        data-target="#modal-ajout-horaire" onclick="createhoraire(this)"
                                        href="{{ route('horaires.store') }}" contrat="{{ $contrat->id }}">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                    <a class="btn btn-outline-primary  " data-toggle="modal"
                                        data-target="#modal-edit-{{ $contrat->id }}" href="">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-danger btn-sm" href="{{ route('contrats.destroy', $contrat->id) }}" onclick="supprimer(this)" data-toggle="modal" data-target="#modal-Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text text-center">
                                    Aucun enregistrement
                                </td>
                            </tr>
                        @endforelse



                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-center pagination-lg">
            {{ $contrats->links('pagination::bootstrap-4') }}
        </div>
    </div>


@endsection

@include('contrats.create')
@include('contrats.createhoraire')
@include('contrats.edit')
@include('contrats.delete')
@push('page_scripts')
    <script>
        function createhoraire(elt) {
            var val = elt.getAttribute('contrat')
            contrat_id.setAttribute('value', val)
            var route = elt.getAttribute('href')
            ajouthoraire.setAttribute('action', route)
        }
        function supprimer(elt){
        var route=elt.getAttribute('href')
        deleteForm.setAttribute('action', route)
      }
    </script>
@endpush

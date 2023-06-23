@extends('layouts.app')
@section('title')
    <span>Horaires</span>
@endsection
@section('content')


    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <ol class=" float-sm-right">
                        @permission('create', 'Direction')
                            <a class="btn btn-light" href="#" data-toggle="modal" data-target="#modal-ajout-horaire"><i
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
                            <th class="text-center col-lg-1">
                                ID
                            </th>
                            <th class="text-center col-lg-1">
                                Nom
                            </th>
                            <th class="text-center col-lg-1">
                                Debut
                            </th>
                            <th class="text-center col-lg-1">
                                Fin
                            </th>
                            <th class="text-center col-lg-1">
                                Pause
                            </th>
                            <th class="text-center col-lg-3">
                                Jours
                            </th>
                            <th class="text-center col-lg-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($horaires as $horaire)
                            <tr class="text-center col-lg-1">
                                <td>{{ $horaire->id }}</td>
                                <td>{{ $horaire->name }}</td>
                                <td>{{ Carbon\Carbon::parse($horaire->heuredebut)->format('H:i') }}</td>
                                <td>{{ Carbon\Carbon::parse($horaire->heurefin)->format('H:i') }}</td>
                                <td>
                                    @if ($horaire->heurepausedebut && $horaire->heurepausefin)
                                        {{ Carbon\Carbon::parse($horaire->heurepausedebut)->format('H:i') }} -
                                        {{ Carbon\Carbon::parse($horaire->heurepausefin)->format('H:i') }}
                                    @else
                                        Pas de pause
                                    @endif
                                </td>
                                <td>{{ $horaire->jours }}</td>
                                <td>
                                    <a class="btn btn-outline-primary  " data-toggle="modal" data-target="#modal-edit-{{ $horaire->id }}" href="">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-danger btn-sm" href="{{ route('horaires.destroy', $horaire->id) }}" onclick="supprimer(this)" data-toggle="modal" data-target="#modal-Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @include('horaires.edit')
                        @include('horaires.delete')
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
            {{ $horaires->links('pagination::bootstrap-4') }}
        </div>
    </div>

    

@endsection

@include('horaires.create')
@push('page_scripts')
    <script>
        function supprimer(elt){
        var route=elt.getAttribute('href')
        deleteForm.setAttribute('action', route)
      }
    </script>
@endpush

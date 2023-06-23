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
                            <th>Type</th>
                            <th>Durée</th>
                            <th>Horaire</th>
                            <th>Fonction</th>
                            <th>Direction</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contrats as $contrat)
                            <tr class="text-center col-lg-1">
                                <td>{{ $contrat->name }}</td>
                                <td>{{ $contrat->description }}</td>
                                <td>{{ $contrat->type }}</td>
                                <td>{{ $contrat->duree }}/{{ $contrat->unite_duree }}</td>
                                <td>{{ $contrat->horaire->name }}</td>
                                <td>{{ $contrat->fonction->name }}</td>
                                <td>{{ $contrat->direction->name }}</td>
                                <td>
                                    <a class="btn btn-outline-primary  " data-toggle="modal"
                                        data-target="#modal-edit-{{ $contrat->id }}" href="">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <a class="btn btn-danger btn-sm" href="{{ route('contrats.destroy', $contrat->id) }}"
                                        onclick="supprimer(this)" data-toggle="modal" data-target="#modal-Delete">
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
@include('contrats.edit')
@include('contrats.delete')
@push('page_scripts')
    <script>
        //modal de création

        var typeContrat = document.getElementById('type');
        var duree = document.getElementById('duree_div');
        var unite_duree = document.getElementById('unite_duree_div');
        var duree_input = document.getElementById('duree');
        var unite_input = document.getElementById('unite_duree')

        typeContrat.addEventListener('change', function() {
            if (typeContrat.value !== 'CDI') {
                duree.style.display = 'block';
                unite_duree.style.display = 'block';
            } else {
                duree.style.display = 'none';
                unite_duree.style.display = 'none';
                duree_input.value = null;
                unite_input.value = null;
            }
        });

        //modal de modification
        @foreach ($contrats as $contrat)
            var modalEdit = document.getElementById('modal-edit-{{ $contrat->id }}');

            var typeContratEdit = modalEdit.querySelector('#type');
            var dureeEdit = modalEdit.querySelector('#duree_div');
            var uniteDureeEdit = modalEdit.querySelector('#unite_duree_div');
            var dureeInputEdit = modalEdit.querySelector('#duree');
            var uniteInputEdit = modalEdit.querySelector('#unite_duree');

            // Vérifie le type de contrat au chargement du modal
            if (typeContratEdit.value !== 'CDI') {

                dureeEdit.style.display = 'block';
                uniteDureeEdit.style.display = 'block';
            } else {
                dureeEdit.style.display = 'none';
                uniteDureeEdit.style.display = 'none';
                dureeInputEdit.value = null;
                uniteInputEdit.value = null;
            }

            // Change la visibilité des champs en fonction du type de contrat
            typeContratEdit.addEventListener('change', function() {
                if (typeContratEdit.value !== 'CDI') {
                    dureeEdit.style.display = 'block';
                    uniteDureeEdit.style.display = 'block';
                } else {
                    dureeEdit.style.display = 'none';
                    uniteDureeEdit.style.display = 'none';
                    dureeInputEdit.value = null;
                    uniteInputEdit.value = null;
                }
            });
        @endforeach

        function supprimer(elt) {
            var route = elt.getAttribute('href')
            deleteForm.setAttribute('action', route)
        }
    </script>
@endpush

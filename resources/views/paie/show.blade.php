@extends('layouts.app')
@section('title')
<span>Paie</span>
@endsection
@section('content')
    @php
    $cpt =1;   
    @endphp
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> Success! {{session('success')}}</h6>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible m-4">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-ban"></i>{{session('error')}}</h6>
                            </div>
                        @endif
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Tous</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Enregistrés</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="{{ route('paie.show', "PAYE") }}" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Payés</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="{{ route('paie.show', "EN ATTENTE") }}" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">En attente</a>
                            </li>
                          </ul>  
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Agent</th>
                                        <th>Nombre des jours</th>
                                        <th>Salaire</th>
                                        <th>Dévise</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text">
                                    @forelse ($paies as $paie) 
                                    <tr>
                                        <td scope="row">{{ $cpt++ }}</td>
                                        <td>{{ strtoupper($paie->user->name) }}</td>
                                        <td>{{ $paie->jours_presents }}</td>
                                        <td>{{ $paie->taux_configuration->montant*$paie->jours_presents }}</td>
                                        <td>{{ ($paie->taux_configuration->devise) }}</td>
                                        <td class="d-flex">
                                            <form action="{{ route('paie.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$paie->id}}">
                                                <input type="hidden" name="taux_id" value="{{$paie->id}}">
                                                <button type="submit" class=" btn btn-outline-success mx-1" title="Ajouter à la liste de paie"><i class="fas fa-plus-circle"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"> 
                                                Aucune paie dispo
                                            </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            
                            <div class="card-footer mt-2">
                                <ul class="pagination pagination-xs m-0 float-right">
                                    <li class="page-item m-1"><a class="page-link" href="{{ $paies->previousPageUrl() }}">Précédent</a></li>
                                    <li class="page-item m-1"><a class="page-link" href="{{ $paies->nextPageUrl() }}">Suivant</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function destroy(event) {
            var route = event.target.getAttribute('href')
            deleteForm.setAttribute('action', route)
            //alert(route)
        }
    </script>
@endsection

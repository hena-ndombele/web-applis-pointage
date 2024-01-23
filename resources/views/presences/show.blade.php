@extends('layouts.app')
@section('title')
    <span>Présence du : {{ $toDay}}</span>
@endsection
@section('content')

 


      
<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Service</th>
                        <th>Département</th>
                        <th>Direction</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>HE</th>
                        <th>HS</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presences as $presence)
                        <tr>
                            <td>{{$presence->id}}</td>
                            <td>{{$presence->user->name}}</td>
                            {{-- @forelse($departements as $departement)
                            <td>{{$dept->departement->name}}</td>
                        @empty
                            <td>Aucun département</td>
                        @endforelse --}}
                            
                            <td>Rôle</td>
                            <td>{{$presence->heureArrive}}</td>
                            <td>{{ date("H:i:s", strtotime($presence->heureDepart) )}}</td>
                            <td>
                                <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                            </td>
                            <td>
                                <button type="button" class="btn  btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}" style="background: red; color:white;">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn  btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}" style="background: green;color:white;">
                                    <i class="fas fa-print"></i>
                                </button>
                                @include('partials.modalPresence')
                            </td>
                        </tr>
                    @empty
                    <h5>Aucune présence signalée</h5>
                @endforelse
                </tbody>
                
                
                </thead>
            </table>
            </div>
            </div>
        </div>

            <div class="m-2 text-center mt-4">
                {{$presences->links()}}
            </div>
        </div>  


@endsection
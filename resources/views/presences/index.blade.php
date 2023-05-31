@extends('layouts.app')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Présences</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            
            
            <div class="card">
                
                <div class="card-header">
                    <h3 class="card-title">Liste de présences</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Noms</th>
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
                                    <td>Rôle</td>
                                    <td>{{$presence->heureArrive}}</td>
                                    <td>{{$presence->heureDepart}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include('partials.modalPresence')
                                    </td>
                                </tr>
                            @empty
                            <h3>Aucune présence ou absence signalé</h3>
                           @endforelse
                        </tbody>
                           
                           
                        </thead>
                    </table>
                    <div class="m-2 text-center mt-4">
                        {{$presences->links()}}
                    </div>
                </div>
            </div>
    </section>
</div>
    
@endsection
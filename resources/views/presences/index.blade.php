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
        <div class="card-body">
            <h4>Liste de présence </h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Jour</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Semaine</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Mois</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Année</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                 {{-- Par jour --}}
                  <div class="card">
                      
                      <div class="card-header">
                        {{$jour}}e jour du mois
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
                                  @forelse ($presenceJournaliere as $presence)
                                      <tr>
                                          <td>{{$presence->id}}</td>
                                          <td>{{$presence->user->name}}</td>
                                          <td>Rôle</td>
                                          <td>{{$presence->heureArrive}}</td>
                                          <td>{{ date("H:i:s", strtotime($presence->heureDepart) )}}</td>
                                          <td>
                                              <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                                          </td>
                                          <td>
                                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}">
                                                  <i class="fas fa-eye"></i>
                                              </button>
                                              <a type="button" class="btn btn-primary btn-sm" href="{{route("presences.show", $presence->user->id)}}">
                                                <i class="fas fa-sort-alpha-down"></i>
                                              </a>
                                              @include('partials.modalPresence')
                                          </td>
                                      </tr>
                                  @empty
                                  <h5>Aucune présence signalée</h5>
                                @endforelse
                              </tbody>
                                
                                
                              </thead>
                          </table>
                          <div class="m-2 text-center mt-4">
                              {{$presences->links()}}
                          </div>
                      </div>
                  </div>
                 {{-- Fin Par jour --}}
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                 {{-- Par semaine --}}
                  <div class="card">
                    <div class="card-header">
                      {{$semaineDeAnnee}}e semaine de l'année, allant du  {{date("d-m", strtotime($debutSemaine)) }} au {{date("d-m", strtotime($finSemaine)) }} 
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
                                @forelse ($presenceHebdo as $presence)
                                    <tr>
                                        <td>{{$presence->id}}</td>
                                        <td>{{$presence->user->name}}</td>
                                        <td>Rôle</td>
                                        <td>{{$presence->heureArrive}}</td>
                                        <td>{{ date("H:i:s", strtotime($presence->heureDepart) )}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a type="button" class="btn btn-primary btn-sm" href="{{route("presences.show", $presence->user->id)}}">
                                                <i class="fas fa-sort-alpha-down"></i>
                                              </a>
                                            @include('partials.modalPresence')
                                        </td>
                                    </tr>
                                @empty
                                <h5>Aucune présence signalée</h5>
                              @endforelse
                            </tbody>
                              
                              
                            </thead>
                        </table>
                        <div class="m-2 text-center mt-4">
                            {{$presences->links()}}
                        </div>
                    </div>
                  </div>
                {{-- Fin Par semaine --}}
              </div>
              <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                {{-- Par mois --}}
                <div class="card">
                  <div class="card-header">
                    {{$mois}}e mois
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
                              @forelse ($presenceMensuel as $presence)
                                  <tr>
                                      <td>{{$presence->id}}</td>
                                      <td>{{$presence->user->name}}</td>
                                      <td>Rôle</td>
                                      <td>{{$presence->heureArrive}}</td>
                                      <td>{{ date("H:i:s", strtotime($presence->heureDepart) )}}</td>
                                      <td>
                                          <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                                      </td>
                                      <td>
                                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}">
                                              <i class="fas fa-eye"></i>
                                          </button>
                                          <a type="button" class="btn btn-primary btn-sm" href="{{route("presences.show", $presence->user->id)}}">
                                            <i class="fas fa-sort-alpha-down"></i>
                                          </a>
                                          @include('partials.modalPresence')
                                      </td>
                                  </tr>
                              @empty
                              <h5>Aucune présence signalée</h5>
                            @endforelse
                          </tbody>
                            
                            
                          </thead>
                      </table>
                      <div class="m-2 text-center mt-4">
                          {{$presences->links()}}
                      </div>
                  </div>
                </div>
                {{-- Fin Par mois --}}
              </div>
              <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                 {{-- Par année --}}
                 <div class="card">
                  <div class="card-header">
                    L'an {{$annee}}
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
                              @forelse ($presenceAnnuel as $presence)
                                  <tr>
                                      <td>{{$presence->id}}</td>
                                      <td>{{$presence->user->name}}</td>
                                      <td>Rôle</td>
                                      <td>{{$presence->heureArrive}}</td>
                                      <td>{{ date("H:i:s", strtotime($presence->heureDepart) )}}</td>
                                      <td>
                                          <button class="btn btn-sm btn-<?php echo ($presence->status == 1) ? 'primary' : 'danger' ?>"><?php echo ($presence->status == 1) ? 'présent' : 'absent' ?></button> 
                                      </td>
                                      <td>
                                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPresence-{{$presence->id}}">
                                              <i class="fas fa-eye"></i>
                                          </button>
                                          <a type="button" class="btn btn-primary btn-sm" href="{{route("presences.show", $presence->user->id)}}">
                                            <i class="fas fa-sort-alpha-down"></i>
                                          </a>
                                          @include('partials.modalPresence')
                                      </td>
                                  </tr>
                              @empty
                              <h5>Aucune présence signalée</h5>
                            @endforelse
                          </tbody>
                            
                            
                          </thead>
                      </table>
                      <div class="m-2 text-center mt-4">
                          {{$presences->links()}}
                      </div>
                  </div>
                 </div>
                 {{-- Fin Par année --}}
               </div>
            </div>
        </div>
            
           
    </section>
</div>
    
@endsection
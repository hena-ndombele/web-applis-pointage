@extends('layouts.app')
@section('title')

    {{ $agents->nom }} 
    {{ $agents->postnom }} 
    {{ $agents->prenom }} 

@endsection
@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                   <div class="row">
                    <h3 class="card-title my-2">
                        <i class="fas fa-edit"></i>
                        
                        {{ $agents->nom }} 
                        {{ $agents->postnom }} 
                        {{ $agents->prenom }} 
        
                    </h3>
                   </div>
                   <div class="row">
                    <h3 class="card-title my-2">
                        
                        
                        <p>{{ $agents->grade}} </p>
                        <p>{{ $agents->fonction }}</p> 
                        {{ $agents->prenom }} 
        
                    </h3>
                   </div>
                   
                    <div class="row">
                        <div class="col-8">
                            <p>Numero de téléphone : {{$agents->numero}}</p>
                            <p>Adreesse mail : {{$agents->email}}</p>
                            <p>Compagnie : {{$agents->email}}</p>

    
                        </div>
                        <div class="col-4">
                            <p>Service: {{$agents->service->name}}</p>
                            <p>Fonction : {{$agents->grade}}</p>
                            <p>Superviseur : {{$agents->superviseur}}</p>
    
    
                        </div>

                    
                    

                   </div>
                </div>
                <div class="col-6">
                    <img src="{{ asset('assets/uploads/agents/1686739456.jpg' ) }}" class="img-fluid" alt="Photo de l'agent">
                </div>
            </div>

        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                        href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                        aria-selected="true">Information professionnelle</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link " id="custom-content-below-task-tab" data-toggle="pill"
                        href="#custom-content-below-task" role="tab" aria-controls="custom-content-below-task"
                        aria-selected="false">Information personnelle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                        href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                        aria-selected="false">Information supplémentaire</a>
                </li>
                <li class="nav-item">
                </li>
                
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                    aria-labelledby="custom-content-below-home-tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="col">
                                    <div class="col-6">
                                        <p>Service: {{$agents->service->name}}</p>
                                        <p>Fonction : {{$agents->grade}}</p>
                                        <p>Superviseur : {{$agents->superviseur}}</p>
                
                
                                    </div>
                                    <hr>
                                    <div class="col-6">
                                        <p>Service: {{$agents->service->name}}</p>
                                        <p>Fonction : {{$agents->grade}}</p>
                                        <p>Superviseur : {{$agents->superviseur}}</p>
                
                
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> </h3>
                                <p class="text-muted"></p><br>
                                <div class="text-muted">
                                    <p class="text-sm">Type de projet<b class="d-block"></b></p>
                                    <p class="text-sm">ProjectOwner<b class="d-block"></b></p>
                                    <p class="text-sm">Option-TTM<b class="d-block"></b></p>
                                </div>
                                <h5 class="mt-5 text-muted">Project files</h5>
                                <ul class="list-unstyled">
                                    

                                </ul>
                                <div class="text-center mt-5 mb-3 row">
                                    <div class=" col-lg-5 nav-item dropdown">
                                        <a class=" btn btn-sm btn-primary nav-link"
                                            href="#">Membres</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade row" id="custom-content-below-task" role="tabpanel"aria-labelledby="custom-content-below-task-tab">
                    <div class="row">
                        <div class="col">
                            <div class="col-6">
                                <p>Matricule : {{$agents->matricule}}</p>

                                <p>Service: {{$agents->service->name}}</p>
                                <p>Departement : {{$agents->departement->name}}</p>
                                <p>Direction : {{$agents->direction->name}}</p>
        
        
                            </div>
                            <hr>
                            <div class="col-6">
                                <p>Grade: {{$agents->grade}}</p>
                                <p>Fonction : {{$agents->fonction}}</p>
                                <p>Superviseur : {{$agents->superviseur}}</p>
                                <p>Date d'embauche : {{$agents->date_n}}</p>
                                
        
        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-jalon" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"aria-labelledby="custom-content-below-profile-tab">
                    <div class="col">
                        <div class="col-6">
                            <p>Etat civil : {{$agents->etat_civil}}</p>
                            <p>Nombre d'enfants : {{$agents->nombre_e}}</p>
                            <p>Niveau d'étude : {{$agents->niveau_etude}}</p>
                            <p>Sexe : {{$agents->sexe}}</p>
                            

    
    
                        </div>
                        
                    </div>

                </div> 
                <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel"
                    aria-labelledby="custom-content-below-settings-tab">
                    <p class="text-center text-black-50 my-2"> N'est pas disponible</p>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('scripts')

<script>
    var tasks=document.querySelector('.tasks')  
   function handleButtomClick(event){
        event.preventDefault();
        tasks.style.width="100px"
        tasks.style.transition="all 2s"
    console.log(tasks)
   }

    
  </script>
@endsection
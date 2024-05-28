@extends('layouts.app')
@section('title')

    {{ $agents->nom }} 
    {{ $agents->postnom }} 
    {{ $agents->prenom }} 

@endsection
@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
           
  </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                        href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                        aria-selected="true" style="color:#008B8B; font-weight:bolder;">Information professionnelle</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link " id="custom-content-below-task-tab" data-toggle="pill"
                        href="#custom-content-below-task" role="tab" aria-controls="custom-content-below-task"
                        aria-selected="false" style="color:#008B8B; font-weight:bolder;">Information personnelle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                        href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                        aria-selected="false" style="color:#008B8B; font-weight:bolder;">Information supplémentaire</a>
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
                                        <p style="font-weight: bolder">SERVICE: {{$agents->service->name}}</p>
                                        <p style="font-weight: bolder">FONCTION : {{$agents->fonction->name}}</p>
                                        <p style="font-weight: bolder">SUPERVISEUR : {{$agents->superviseur}}</p>
                                        <p style="font-weight: bolder">DEPARTEMENT : {{$agents->departement->name}}</p>
                                        <p style="font-weight: bolder">DIRECTION : {{$agents->direction->name}}</p>
                                        <p style="font-weight: bolder">MATRICULE : {{$agents->matricule}}</p>
                                        <p style="font-weight: bolder">SUPERVISEUR : {{$agents->superviseur}}</p>
                                        <p style="font-weight: bolder">GRADE : {{$agents->grade->name}}</p>
                                        <p style="font-weight: bolder">DATE EMBAUCHE : {{$agents->date_e}}</p>

                                    </div>
                                    <hr>
                             
                                </div>
                                
                            </div>
                        
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade row" id="custom-content-below-task" role="tabpanel"aria-labelledby="custom-content-below-task-tab">
                    <div class="row">
                        <div class="col">
                            <div class="col-6">
                                
                                <p style="font-weight: bolder">NOM COMPLET : {{$agents->prenom}}</p>
                                <p style="font-weight: bolder">TELEPHONE : {{$agents->numero}}</p>
                                <p style="font-weight: bolder">ADRESSE : {{$agents->adresse}}</p>
                                <p style="font-weight: bolder">EMAIL : {{$agents->email}}</p>
                                <p style="font-weight: bolder">DATE DE NAISSANCE : {{$agents->date_n}}</p> </div>
                           
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-jalon" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"aria-labelledby="custom-content-below-profile-tab">
                    <div class="col">
                        <div class="col-6">
                            <p style="font-weight: bolder">ETAT CIVIL : {{$agents->etat_civil}}</p>
                            <p style="font-weight: bolder">NOMBRE ENFANTS : {{$agents->nombre_e}}</p>
                            <p style="font-weight: bolder">NIVEAU ETUDE : {{$agents->niveau_etude}}</p>
                            <p style="font-weight: bolder">SEXE : {{$agents->sexe}}</p>
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
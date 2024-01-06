@extends('layouts.app')

@section('content')
    <form action="{{ route('agents.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-10 container my-4">
            <div class="card card-default">
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
                <div class="card-header">
                    <h3 class="card-title">Enregistrement employé</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#logins-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                    id="logins-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Information</span>
                                </button>
                            </div>
                            <div class="line"></div>

                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                    id="information-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Information professionnelle</span>
                                </button>
                            </div>
                            <div class="line"></div>

                            <div class="step" data-target="#complexity-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="complexity-part"
                                    id="complexity-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Information supplémentaire</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Nom" name="nom" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Postnom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Postnom" name="postnom" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prenom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Prenom" name="prenom" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date de naissance <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="exampleInputEmail1"
                                        placeholder="" name="date_n" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Numéro de téléphone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Numero de téléphone" name="numero" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Email" name="email" @required(true)>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">IMEI <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="IMEI" name="imei" @required(true)>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Adresse <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Adresse" name="adresse" @required(true)>
                                </div>

                                
                               
                               
                                <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
                            </div>
                            {{-- fin de la partie 1 --}}

                            <div id="information-part" class="content" role="tabpanel"
                                aria-labelledby="information-part-trigger">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service<span class="text-danger">*</span></label>
                                        <select change class="select3" multiple name="service_id" data-placeholder="Service" style="width: 100%;">
                                
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Departement <span class="text-danger">*</span></label>
                                        <select class="select2" multiple="multiple" name="departement_id" data-placeholder="Departement" style="width: 100%;">
                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Direction<span class="text-danger">*</span></label>
                                        <select class="select1" multiple="multiple" name="direction_id"  data-placeholder="Direction" style="width: 100%;">
                                            
                                        </select>
                                    </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Matricule <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Matricule" name="matricule" @required(false)>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Superviseur <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Nom" name="superviseur" @required(true)>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'embauche <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="exampleInputEmail1"
                                            placeholder="Date d'embauche" name="date_e" @required(true)>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Grade<span class="text-danger">*</span></label>
                                        <select class="custom-select form-control" id="exampleSelectBorder" name="grade_id">
                                            <option value="" disabled selected>Grade</option>
                                            <option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </option>
                                        </select>       
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fonction <span class="text-danger">*</span></label>
                                        <select class="custom-select form-control" id="exampleSelectBorder" name="fonction_id" >
                                            <option value="" disabled selected>Fonction</option>
                                            <option>
                                                @foreach ($fonctions as $fonction)
                                                    <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                                @endforeach
                                            </option>
                                        </select> 
                                    </div>
                                   

                                </div>
                                <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>

                            </div>
                            {{-- fin de la partie 2 --}}
                            <div id="complexity-part" class="content" role="tabpanel"
                                aria-labelledby="complexity-part-trigger">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Etat civil <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Etat civil" name="etat_civil" @required(true)>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre d'enfants <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            placeholder="Nombre d'enfants" name="nombre_e" @required(true)>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Niveau d'études <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Niveau d'etudes" name="niveau_etude" @required(true)>
                                    </div>
                                    <div class="col-md-12 ">
                                        <label for="image">Image</label>

                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="sexe">Sexe</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="masculin" value="masculin" >
                                            <label class="form-check-label" for="masculin">
                                                Masculin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="feminin" value="feminin" >
                                            <label class="form-check-label" for="feminin">
                                                Féminin
                                            </label>
                                        </div>
                                        
                                            <input type="hidden" name="conge_utilises" value="0">
                                        
                                    </div>
                                </div>
                                
                                <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                <button class="btn btn-primary" id="test" type="submit">Submit</button>
                            </div>




                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
               

</div>
            <!-- /.card -->
        </div>
    </form>
@endsection

@push('page_css')
    @vite('node_modules/bs-stepper/dist/css/bs-stepper.min.css');
    @vite('node_modules/admin-lte/plugins/select2/css/select2.min.css')    
@endpush

@push('page_scripts')
    <script type="module" src="{{ Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <script type="module" src="{{ Vite::asset('node_modules/bs-stepper/dist/js/bs-stepper.min.js') }}"></script>
    <script type="module" src="{{ Vite::asset('node_modules/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>


<script type="module">

   var departements = @json($departements->map(function ($departement) {
        return ['id' => $departement->id, 'text' => $departement->name];
    })->toArray());
    $(function () {
        $('.select2').select2({
            data: departements
        });
    });
</script>
<script type="module">

    var directions = @json($directions->map(function ($direction) {
        return ['id' => $direction->id, 'text' => $direction->name];
    })->toArray());
    $(function () {
        $('.select1').select2({
            data: directions
        });
    });
</script>
<script type="module">
   
     var services = @json($services->map(function ($service) {
        return ['id' => $service->id, 'text' => $service->name];
    })->toArray());
    $(function () {
        $('.select3').select2({
            data: services
        });
    });
</script>
<script type="module">
 
    $(document).ready(function() {
  $('.select2').on('change', function() {
    if ($(this).val() != null && $(this).val().length > 1) {
      $(this).val([$(this).val().pop()]).trigger('change');
    }
  });
});
</script>
<script type="module">

 $(document).ready(function() {
  $('.select3').on('change', function() {
    if ($(this).val() != null && $(this).val().length > 1) {
      $(this).val([$(this).val().pop()]).trigger('change');
    }
  });
});
</script>

    <script type="module">
       
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function(e) {
            e.preventDefault();
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        
    </script>
  
  <script type="module">
   
   $('.select3').on('change', function() {
  var serviceId = $(this).val();
  $.ajax({
    url: '/get-departement-by-service',
    type: 'GET',
    data: {service_id: serviceId},
    success: function(response) {
      // Code pour mettre à jour la liste déroulante de département avec la réponse
      $('.select2').val(response.departement.id).trigger('change');
    },
    error: function(xhr) {
      // Code pour gérer les erreurs AJAX
    }
  });
});
  </script>
    
@endpush








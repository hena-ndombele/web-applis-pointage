@extends('layouts.app')
@section('title')
    <span>Agent/ {{$agents->nom}} {{$agents->postnom}}</span>
@endsection

@section('content')
    <form action="{{ route('agents.update',$agents->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                    <h3 class="card-title">Enregistrement d'un agent</h3>
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
                                        placeholder="Nom" name="nom" @required(true) readonly value="{{$agents->nom}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Postnom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Postnom" name="postnom" @required(true)   readonly value="{{$agents->postnom}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prenom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Prenom" name="prenom" @required(true)  readonly value="{{$agents->prenom}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date de naissance <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="exampleInputEmail1"
                                        placeholder="" name="date_n" @required(true)  readonly value="{{$agents->date_n}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Numéro de téléphone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Numero de téléphone" name="numero" @required(true) value="{{$agents->numero}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="nom du projet" name="email" @required(true)   value="{{$agents->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Adresse <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Adresse" name="adresse" @required(true) value="{{$agents->adresse}}">
                                </div>
                                
                               
                               
                                <a class="btn btn-primary" onclick="stepper.next()">Suivant</a>
                            </div>
                            {{-- fin de la partie 1 --}}

                            <div id="information-part" class="content" role="tabpanel"
                                aria-labelledby="information-part-trigger">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service<span class="text-danger">*</span></label>
                                        <select change class="select3" multiple id='autocomplete' name="service_id" data-placeholder="Service" style="width: 100%;">
                                
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}" @if ($agents->service_id == $service->id) selected @endif> {{$service->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Departement <span class="text-danger">*</span></label>
                                        <select class="select2" multiple="multiple" id="departement_id" name="departement_id" data-placeholder="Departement" style="width: 100%;">
                                            @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}" @if ($service->departement_id == $departement->id) selected @endif> {{$departement->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Direction<span class="text-danger">*</span></label>
                                        <select class="select1" multiple="multiple" id="direction_id" name="direction_id"  data-placeholder="Direction" style="width: 100%;">
                                            @foreach ($directions as $direction)
                                            <option value="{{$direction->id}}" @if ($service->direction_id == $direction->id) selected @endif> {{$direction->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Matricule <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Matricule" name="matricule" @required(false) readonly value="{{$agents->matricule}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Superviseur <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Nom" name="superviseur" @required(true) value="{{$agents->superviseur}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'embauche <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="exampleInputEmail1"
                                            placeholder="Date d'embauche" name="date_e" @required(true) readonly value="{{$agents->date_n}}">
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
                                            placeholder="Etat civil" name="etat_civil" @required(true) value="{{$agents->etat_civil}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre d'enfants <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            placeholder="Nombre d'enfants" name="nombre_e" @required(true) value="{{$agents->nombre_e}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Niveau d'études <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Niveau d'etudes" name="niveau_etude" @required(true) value="{{$agents->niveau_etude}}">
                                    </div>
                                    @if($agents->image)
                                    <img src="{{asset('assets/uploads/agents/'.$agents->image)}}" alt="" style="max-width: 100%; max-height: 200px;">
                                @endif
                                    <div class="col-md-12 ">
                                        <label for="image">Image</label>

                                        <input type="file" class="form-control" value="{{$agents->image}}" name="image" accept="image/*">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="sexe">Sexe</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="masculin" value="masculin" {{ $agents->sexe == 'Masculin' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="masculin">
                                                Masculin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexe" id="feminin" value="feminin" {{ $agents->sexe == 'Feminin' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="feminin">
                                                Féminin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <a class="btn btn-primary" onclick="stepper.previous()">Précedent</a>
                                <button class="btn btn-primary" id="test" type="submit">Submit</button>
                            </div>




                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-black">
                    Orange Digital Center
                </div>

</div>
            <!-- /.card -->
        </div>
    </form>
@endsection
@section('scripts')
    @vite('node_modules/bs-stepper/dist/js/bs-stepper.min.js');
    @vite('node_modules/bs-stepper/dist/css/bs-stepper.min.css');
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
@vite('node_modules/admin-lte/plugins/select2/css/select2.min.css')
<script src="{{ Vite::asset('node_modules/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
        var departements = @json($departements->pluck('name')->toArray());
        $(function () {
        $('.select2').select2({
            data: departements
        });
    });
</script>
<script>
    var directions = @json($directions->pluck('name')->toArray());
    $(function () {
    $('.select1').select2({
        data: directions
    });
});
</script>
<script>
    var services = @json($services->pluck('name')->toArray());
    $(function () {
    $('.select3').select2({
        data: services
    });
});
</script>
<script>
    $(document).ready(function() {
  $('.select2').on('change', function() {
    if ($(this).val() != null && $(this).val().length > 1) {
      $(this).val([$(this).val().pop()]).trigger('change');
    }
  });
});
</script>
<script>
 $(document).ready(function() {
  $('.select3').on('change', function() {
    if ($(this).val() != null && $(this).val().length > 1) {
      $(this).val([$(this).val().pop()]).trigger('change');
    }
  });
});
</script>

    <script>
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function(e) {
            e.preventDefault();
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        
    </script>
  
  <script>
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
    
@endsection
@section('scripts')
  <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
  <script src="{{ Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript">
    var arrayReturn=[];
    $.ajax({
      url:'/get-departement-by-service',
      async: true,
      dataType: 'json',
      success: function(data){
        for(var i=0; i<data.length;i++){ // Correction de la variable "len"
          var id=(data[i].id).toString();
          arrayReturn.push({
            'direction_id':data[i].direction_id,
            'departement_id':data[i].departement_id,          
            'data':id
          });
        }
        loadSuggestions(arrayReturn);
      }
    }); // Ajout de l'accolade fermante

    function loadSuggestions(options){
      $('#autocomplete').autocomplete(
        {
          lookup:options,
          onSelect: function (suggestion){
            $('#direction_id').html(suggestion.direction_id);
            $('#departement_id').html(suggestion.departement_id);
           
          }
        }
      );
    }
  </script>
@endsection






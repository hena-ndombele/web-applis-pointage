<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Service</font></font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{Route("services.store")}}" class="vstack grap" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="" for="classe_therapeutique">Direction</label>
                        </div>
                        <select onchange="chargeDepartement()" name="direction_id" class="custom-select select1" id="direction" style="width: 100%">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="" for="classe_therapeutique">Departement</label>
                        </div>
                        <select  name="departement_id" class="custom-select" id="select2" style="width: 100%">
                            
                        </select>
                    </div>
                  
    <input type="hidden" name="" id="byDirection" value="{{route('byDirection')}}">
                    
                    <div class="form-group mb-3">
                        <label for="name">Service</label>
                        <input type="text" name="name"  class="form-control"
                            placeholder="Entrez la direction" value="{{ old('name') }}">
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
                     </div>
                
                
                
                
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @vite('node_modules/bs-stepper/dist/js/bs-stepper.min.js');
    @vite('node_modules/bs-stepper/dist/css/bs-stepper.min.css');
    <script src="{{ Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
@vite('node_modules/admin-lte/plugins/select2/css/select2.min.css')
<script src="{{ Vite::asset('node_modules/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>


<script>
    var directions = @json($directions->map(function ($direction) {
        return ['id' => $direction->id, 'text' => $direction->name];
    })->toArray());
    $(function () {
        $('#direction').select2({
            data: directions
        });
    });
</script>
<script>
    function chargeDepartement (){
        let i = $('#direction').val()
        let url = $('#byDirection').val();
        url += '/'+i
        

        $.get(url, function(data){
            $('#select2').append('<option value=""></option>')

            data.map(rep=>{
                $('#select2').append('<option value="'+rep.id+'">'+rep.name+'</option>')
            })
        })
    }
</script>
@endsection
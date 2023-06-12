@foreach ($departements as $departement)
<div class="modal fade" id="edit-{{$departement->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Modifier une direction</font></font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{Route("departements.update", $departement->id)}}" class="vstack grap" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="classe_therapeutique">Direction</label>
                            </div>
                            <select  name="direction_id" class="custom-select" id="">
                                <option value=""></option>
                                @foreach($directions as $direction)
                                <option value="{{ $direction->id }}" @if ($departement->direction_id == $direction->id) selected @endif>{{ $direction->name }}</option>
                                 @endforeach
                            </select>
                        </div>
                      
                        
                        <div class="form-group mb-3">
                            <label for="name">Departement</label>
                            <input type="text" name="name"  class="form-control"
                                placeholder="Entrez la direction" value="{{ $departement->name }}">
                        </div>
                    
                    <div>
                        <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
                     </div>
                
                
                
                
                </form>
            </div>
        </div>
    </div>
</div>   
@endforeach
